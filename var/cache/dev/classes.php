<?php 
namespace Symfony\Component\EventDispatcher
{
interface EventSubscriberInterface
{
public static function getSubscribedEvents();
}
}
namespace Symfony\Component\HttpKernel\EventListener
{
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
abstract class SessionListener implements EventSubscriberInterface
{
public function onKernelRequest(GetResponseEvent $event)
{
if (!$event->isMasterRequest()) {
return;
}
$request = $event->getRequest();
$session = $this->getSession();
if (null === $session || $request->hasSession()) {
return;
}
$request->setSession($session);
}
public static function getSubscribedEvents()
{
return array(
KernelEvents::REQUEST => array('onKernelRequest', 128),
);
}
abstract protected function getSession();
}
}
namespace Symfony\Bundle\FrameworkBundle\EventListener
{
use Symfony\Component\HttpKernel\EventListener\SessionListener as BaseSessionListener;
use Symfony\Component\DependencyInjection\ContainerInterface;
class SessionListener extends BaseSessionListener
{
private $container;
public function __construct(ContainerInterface $container)
{
$this->container = $container;
}
protected function getSession()
{
if (!$this->container->has('session')) {
return;
}
return $this->container->get('session');
}
}
}
namespace Symfony\Component\HttpFoundation\Session\Storage
{
use Symfony\Component\HttpFoundation\Session\SessionBagInterface;
interface SessionStorageInterface
{
public function start();
public function isStarted();
public function getId();
public function setId($id);
public function getName();
public function setName($name);
public function regenerate($destroy = false, $lifetime = null);
public function save();
public function clear();
public function getBag($name);
public function registerBag(SessionBagInterface $bag);
public function getMetadataBag();
}
}
namespace Symfony\Component\HttpFoundation\Session\Storage
{
use Symfony\Component\HttpFoundation\Session\SessionBagInterface;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeSessionHandler;
use Symfony\Component\HttpFoundation\Session\Storage\Proxy\NativeProxy;
use Symfony\Component\HttpFoundation\Session\Storage\Proxy\AbstractProxy;
use Symfony\Component\HttpFoundation\Session\Storage\Proxy\SessionHandlerProxy;
class NativeSessionStorage implements SessionStorageInterface
{
protected $bags;
protected $started = false;
protected $closed = false;
protected $saveHandler;
protected $metadataBag;
public function __construct(array $options = array(), $handler = null, MetadataBag $metaBag = null)
{
session_cache_limiter(''); ini_set('session.use_cookies', 1);
session_register_shutdown();
$this->setMetadataBag($metaBag);
$this->setOptions($options);
$this->setSaveHandler($handler);
}
public function getSaveHandler()
{
return $this->saveHandler;
}
public function start()
{
if ($this->started) {
return true;
}
if (PHP_VERSION_ID >= 50400 && \PHP_SESSION_ACTIVE === session_status()) {
throw new \RuntimeException('Failed to start the session: already started by PHP.');
}
if (PHP_VERSION_ID < 50400 && !$this->closed && isset($_SESSION) && session_id()) {
throw new \RuntimeException('Failed to start the session: already started by PHP ($_SESSION is set).');
}
if (ini_get('session.use_cookies') && headers_sent($file, $line)) {
throw new \RuntimeException(sprintf('Failed to start the session because headers have already been sent by "%s" at line %d.', $file, $line));
}
if (!session_start()) {
throw new \RuntimeException('Failed to start the session');
}
$this->loadSession();
if (!$this->saveHandler->isWrapper() && !$this->saveHandler->isSessionHandlerInterface()) {
$this->saveHandler->setActive(true);
}
return true;
}
public function getId()
{
return $this->saveHandler->getId();
}
public function setId($id)
{
$this->saveHandler->setId($id);
}
public function getName()
{
return $this->saveHandler->getName();
}
public function setName($name)
{
$this->saveHandler->setName($name);
}
public function regenerate($destroy = false, $lifetime = null)
{
if (PHP_VERSION_ID >= 50400 && \PHP_SESSION_ACTIVE !== session_status()) {
return false;
}
if (PHP_VERSION_ID < 50400 &&''=== session_id()) {
return false;
}
if (null !== $lifetime) {
ini_set('session.cookie_lifetime', $lifetime);
}
if ($destroy) {
$this->metadataBag->stampNew();
}
$isRegenerated = session_regenerate_id($destroy);
$this->loadSession();
return $isRegenerated;
}
public function save()
{
session_write_close();
if (!$this->saveHandler->isWrapper() && !$this->saveHandler->isSessionHandlerInterface()) {
$this->saveHandler->setActive(false);
}
$this->closed = true;
$this->started = false;
}
public function clear()
{
foreach ($this->bags as $bag) {
$bag->clear();
}
$_SESSION = array();
$this->loadSession();
}
public function registerBag(SessionBagInterface $bag)
{
if ($this->started) {
throw new \LogicException('Cannot register a bag when the session is already started.');
}
$this->bags[$bag->getName()] = $bag;
}
public function getBag($name)
{
if (!isset($this->bags[$name])) {
throw new \InvalidArgumentException(sprintf('The SessionBagInterface %s is not registered.', $name));
}
if ($this->saveHandler->isActive() && !$this->started) {
$this->loadSession();
} elseif (!$this->started) {
$this->start();
}
return $this->bags[$name];
}
public function setMetadataBag(MetadataBag $metaBag = null)
{
if (null === $metaBag) {
$metaBag = new MetadataBag();
}
$this->metadataBag = $metaBag;
}
public function getMetadataBag()
{
return $this->metadataBag;
}
public function isStarted()
{
return $this->started;
}
public function setOptions(array $options)
{
$validOptions = array_flip(array('cache_limiter','cookie_domain','cookie_httponly','cookie_lifetime','cookie_path','cookie_secure','entropy_file','entropy_length','gc_divisor','gc_maxlifetime','gc_probability','hash_bits_per_character','hash_function','name','referer_check','serialize_handler','use_cookies','use_only_cookies','use_trans_sid','upload_progress.enabled','upload_progress.cleanup','upload_progress.prefix','upload_progress.name','upload_progress.freq','upload_progress.min-freq','url_rewriter.tags',
));
foreach ($options as $key => $value) {
if (isset($validOptions[$key])) {
ini_set('session.'.$key, $value);
}
}
}
public function setSaveHandler($saveHandler = null)
{
if (!$saveHandler instanceof AbstractProxy &&
!$saveHandler instanceof NativeSessionHandler &&
!$saveHandler instanceof \SessionHandlerInterface &&
null !== $saveHandler) {
throw new \InvalidArgumentException('Must be instance of AbstractProxy or NativeSessionHandler; implement \SessionHandlerInterface; or be null.');
}
if (!$saveHandler instanceof AbstractProxy && $saveHandler instanceof \SessionHandlerInterface) {
$saveHandler = new SessionHandlerProxy($saveHandler);
} elseif (!$saveHandler instanceof AbstractProxy) {
$saveHandler = PHP_VERSION_ID >= 50400 ?
new SessionHandlerProxy(new \SessionHandler()) : new NativeProxy();
}
$this->saveHandler = $saveHandler;
if ($this->saveHandler instanceof \SessionHandlerInterface) {
if (PHP_VERSION_ID >= 50400) {
session_set_save_handler($this->saveHandler, false);
} else {
session_set_save_handler(
array($this->saveHandler,'open'),
array($this->saveHandler,'close'),
array($this->saveHandler,'read'),
array($this->saveHandler,'write'),
array($this->saveHandler,'destroy'),
array($this->saveHandler,'gc')
);
}
}
}
protected function loadSession(array &$session = null)
{
if (null === $session) {
$session = &$_SESSION;
}
$bags = array_merge($this->bags, array($this->metadataBag));
foreach ($bags as $bag) {
$key = $bag->getStorageKey();
$session[$key] = isset($session[$key]) ? $session[$key] : array();
$bag->initialize($session[$key]);
}
$this->started = true;
$this->closed = false;
}
}
}
namespace Symfony\Component\HttpFoundation\Session\Storage
{
use Symfony\Component\HttpFoundation\Session\Storage\Proxy\AbstractProxy;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeSessionHandler;
class PhpBridgeSessionStorage extends NativeSessionStorage
{
public function __construct($handler = null, MetadataBag $metaBag = null)
{
$this->setMetadataBag($metaBag);
$this->setSaveHandler($handler);
}
public function start()
{
if ($this->started) {
return true;
}
$this->loadSession();
if (!$this->saveHandler->isWrapper() && !$this->saveHandler->isSessionHandlerInterface()) {
$this->saveHandler->setActive(true);
}
return true;
}
public function clear()
{
foreach ($this->bags as $bag) {
$bag->clear();
}
$this->loadSession();
}
}
}
namespace Symfony\Component\HttpFoundation\Session\Storage\Handler
{
if (PHP_VERSION_ID >= 50400) {
class NativeSessionHandler extends \SessionHandler
{
}
} else {
class NativeSessionHandler
{
}
}
}
namespace Symfony\Component\HttpFoundation\Session\Storage\Handler
{
class NativeFileSessionHandler extends NativeSessionHandler
{
public function __construct($savePath = null)
{
if (null === $savePath) {
$savePath = ini_get('session.save_path');
}
$baseDir = $savePath;
if ($count = substr_count($savePath,';')) {
if ($count > 2) {
throw new \InvalidArgumentException(sprintf('Invalid argument $savePath \'%s\'', $savePath));
}
$baseDir = ltrim(strrchr($savePath,';'),';');
}
if ($baseDir && !is_dir($baseDir) && !@mkdir($baseDir, 0777, true) && !is_dir($baseDir)) {
throw new \RuntimeException(sprintf('Session Storage was not able to create directory "%s"', $baseDir));
}
ini_set('session.save_path', $savePath);
ini_set('session.save_handler','files');
}
}
}
namespace Symfony\Component\HttpFoundation\Session\Storage\Proxy
{
abstract class AbstractProxy
{
protected $wrapper = false;
protected $active = false;
protected $saveHandlerName;
public function getSaveHandlerName()
{
return $this->saveHandlerName;
}
public function isSessionHandlerInterface()
{
return $this instanceof \SessionHandlerInterface;
}
public function isWrapper()
{
return $this->wrapper;
}
public function isActive()
{
if (PHP_VERSION_ID >= 50400) {
return $this->active = \PHP_SESSION_ACTIVE === session_status();
}
return $this->active;
}
public function setActive($flag)
{
if (PHP_VERSION_ID >= 50400) {
throw new \LogicException('This method is disabled in PHP 5.4.0+');
}
$this->active = (bool) $flag;
}
public function getId()
{
return session_id();
}
public function setId($id)
{
if ($this->isActive()) {
throw new \LogicException('Cannot change the ID of an active session');
}
session_id($id);
}
public function getName()
{
return session_name();
}
public function setName($name)
{
if ($this->isActive()) {
throw new \LogicException('Cannot change the name of an active session');
}
session_name($name);
}
}
}
namespace Symfony\Component\HttpFoundation\Session\Storage\Proxy
{
class SessionHandlerProxy extends AbstractProxy implements \SessionHandlerInterface
{
protected $handler;
public function __construct(\SessionHandlerInterface $handler)
{
$this->handler = $handler;
$this->wrapper = ($handler instanceof \SessionHandler);
$this->saveHandlerName = $this->wrapper ? ini_get('session.save_handler') :'user';
}
public function open($savePath, $sessionName)
{
$return = (bool) $this->handler->open($savePath, $sessionName);
if (true === $return) {
$this->active = true;
}
return $return;
}
public function close()
{
$this->active = false;
return (bool) $this->handler->close();
}
public function read($sessionId)
{
return (string) $this->handler->read($sessionId);
}
public function write($sessionId, $data)
{
return (bool) $this->handler->write($sessionId, $data);
}
public function destroy($sessionId)
{
return (bool) $this->handler->destroy($sessionId);
}
public function gc($maxlifetime)
{
return (bool) $this->handler->gc($maxlifetime);
}
}
}
namespace Symfony\Component\HttpFoundation\Session
{
use Symfony\Component\HttpFoundation\Session\Storage\MetadataBag;
interface SessionInterface
{
public function start();
public function getId();
public function setId($id);
public function getName();
public function setName($name);
public function invalidate($lifetime = null);
public function migrate($destroy = false, $lifetime = null);
public function save();
public function has($name);
public function get($name, $default = null);
public function set($name, $value);
public function all();
public function replace(array $attributes);
public function remove($name);
public function clear();
public function isStarted();
public function registerBag(SessionBagInterface $bag);
public function getBag($name);
public function getMetadataBag();
}
}
namespace Symfony\Component\HttpFoundation\Session
{
use Symfony\Component\HttpFoundation\Session\Storage\SessionStorageInterface;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBagInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
class Session implements SessionInterface, \IteratorAggregate, \Countable
{
protected $storage;
private $flashName;
private $attributeName;
public function __construct(SessionStorageInterface $storage = null, AttributeBagInterface $attributes = null, FlashBagInterface $flashes = null)
{
$this->storage = $storage ?: new NativeSessionStorage();
$attributes = $attributes ?: new AttributeBag();
$this->attributeName = $attributes->getName();
$this->registerBag($attributes);
$flashes = $flashes ?: new FlashBag();
$this->flashName = $flashes->getName();
$this->registerBag($flashes);
}
public function start()
{
return $this->storage->start();
}
public function has($name)
{
return $this->storage->getBag($this->attributeName)->has($name);
}
public function get($name, $default = null)
{
return $this->storage->getBag($this->attributeName)->get($name, $default);
}
public function set($name, $value)
{
$this->storage->getBag($this->attributeName)->set($name, $value);
}
public function all()
{
return $this->storage->getBag($this->attributeName)->all();
}
public function replace(array $attributes)
{
$this->storage->getBag($this->attributeName)->replace($attributes);
}
public function remove($name)
{
return $this->storage->getBag($this->attributeName)->remove($name);
}
public function clear()
{
$this->storage->getBag($this->attributeName)->clear();
}
public function isStarted()
{
return $this->storage->isStarted();
}
public function getIterator()
{
return new \ArrayIterator($this->storage->getBag($this->attributeName)->all());
}
public function count()
{
return count($this->storage->getBag($this->attributeName)->all());
}
public function invalidate($lifetime = null)
{
$this->storage->clear();
return $this->migrate(true, $lifetime);
}
public function migrate($destroy = false, $lifetime = null)
{
return $this->storage->regenerate($destroy, $lifetime);
}
public function save()
{
$this->storage->save();
}
public function getId()
{
return $this->storage->getId();
}
public function setId($id)
{
$this->storage->setId($id);
}
public function getName()
{
return $this->storage->getName();
}
public function setName($name)
{
$this->storage->setName($name);
}
public function getMetadataBag()
{
return $this->storage->getMetadataBag();
}
public function registerBag(SessionBagInterface $bag)
{
$this->storage->registerBag($bag);
}
public function getBag($name)
{
return $this->storage->getBag($name);
}
public function getFlashBag()
{
return $this->getBag($this->flashName);
}
}
}
namespace Symfony\Bundle\FrameworkBundle\Templating
{
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\SecurityContext;
class GlobalVariables
{
protected $container;
public function __construct(ContainerInterface $container)
{
$this->container = $container;
}
public function getSecurity()
{
@trigger_error('The '.__METHOD__.' method is deprecated since version 2.6 and will be removed in 3.0.', E_USER_DEPRECATED);
if ($this->container->has('security.context')) {
return $this->container->get('security.context');
}
}
public function getUser()
{
if (!$this->container->has('security.token_storage')) {
return;
}
$tokenStorage = $this->container->get('security.token_storage');
if (!$token = $tokenStorage->getToken()) {
return;
}
$user = $token->getUser();
if (!is_object($user)) {
return;
}
return $user;
}
public function getRequest()
{
if ($this->container->has('request_stack')) {
return $this->container->get('request_stack')->getCurrentRequest();
}
}
public function getSession()
{
if ($request = $this->getRequest()) {
return $request->getSession();
}
}
public function getEnvironment()
{
return $this->container->getParameter('kernel.environment');
}
public function getDebug()
{
return (bool) $this->container->getParameter('kernel.debug');
}
}
}
namespace Symfony\Component\Templating
{
interface TemplateReferenceInterface
{
public function all();
public function set($name, $value);
public function get($name);
public function getPath();
public function getLogicalName();
public function __toString();
}
}
namespace Symfony\Component\Templating
{
class TemplateReference implements TemplateReferenceInterface
{
protected $parameters;
public function __construct($name = null, $engine = null)
{
$this->parameters = array('name'=> $name,'engine'=> $engine,
);
}
public function __toString()
{
return $this->getLogicalName();
}
public function set($name, $value)
{
if (array_key_exists($name, $this->parameters)) {
$this->parameters[$name] = $value;
} else {
throw new \InvalidArgumentException(sprintf('The template does not support the "%s" parameter.', $name));
}
return $this;
}
public function get($name)
{
if (array_key_exists($name, $this->parameters)) {
return $this->parameters[$name];
}
throw new \InvalidArgumentException(sprintf('The template does not support the "%s" parameter.', $name));
}
public function all()
{
return $this->parameters;
}
public function getPath()
{
return $this->parameters['name'];
}
public function getLogicalName()
{
return $this->parameters['name'];
}
}
}
namespace Symfony\Bundle\FrameworkBundle\Templating
{
use Symfony\Component\Templating\TemplateReference as BaseTemplateReference;
class TemplateReference extends BaseTemplateReference
{
public function __construct($bundle = null, $controller = null, $name = null, $format = null, $engine = null)
{
$this->parameters = array('bundle'=> $bundle,'controller'=> $controller,'name'=> $name,'format'=> $format,'engine'=> $engine,
);
}
public function getPath()
{
$controller = str_replace('\\','/', $this->get('controller'));
$path = (empty($controller) ?'': $controller.'/').$this->get('name').'.'.$this->get('format').'.'.$this->get('engine');
return empty($this->parameters['bundle']) ?'views/'.$path :'@'.$this->get('bundle').'/Resources/views/'.$path;
}
public function getLogicalName()
{
return sprintf('%s:%s:%s.%s.%s', $this->parameters['bundle'], $this->parameters['controller'], $this->parameters['name'], $this->parameters['format'], $this->parameters['engine']);
}
}
}
namespace Symfony\Component\Templating
{
interface TemplateNameParserInterface
{
public function parse($name);
}
}
namespace Symfony\Component\Templating
{
class TemplateNameParser implements TemplateNameParserInterface
{
public function parse($name)
{
if ($name instanceof TemplateReferenceInterface) {
return $name;
}
$engine = null;
if (false !== $pos = strrpos($name,'.')) {
$engine = substr($name, $pos + 1);
}
return new TemplateReference($name, $engine);
}
}
}
namespace Symfony\Bundle\FrameworkBundle\Templating
{
use Symfony\Component\Templating\TemplateReferenceInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Templating\TemplateNameParser as BaseTemplateNameParser;
class TemplateNameParser extends BaseTemplateNameParser
{
protected $kernel;
protected $cache = array();
public function __construct(KernelInterface $kernel)
{
$this->kernel = $kernel;
}
public function parse($name)
{
if ($name instanceof TemplateReferenceInterface) {
return $name;
} elseif (isset($this->cache[$name])) {
return $this->cache[$name];
}
$name = str_replace(':/',':', preg_replace('#/{2,}#','/', str_replace('\\','/', $name)));
if (false !== strpos($name,'..')) {
throw new \RuntimeException(sprintf('Template name "%s" contains invalid characters.', $name));
}
if (!preg_match('/^(?:([^:]*):([^:]*):)?(.+)\.([^\.]+)\.([^\.]+)$/', $name, $matches) || $this->isAbsolutePath($name) || 0 === strpos($name,'@')) {
return parent::parse($name);
}
$template = new TemplateReference($matches[1], $matches[2], $matches[3], $matches[4], $matches[5]);
if ($template->get('bundle')) {
try {
$this->kernel->getBundle($template->get('bundle'));
} catch (\Exception $e) {
throw new \InvalidArgumentException(sprintf('Template name "%s" is not valid.', $name), 0, $e);
}
}
return $this->cache[$name] = $template;
}
private function isAbsolutePath($file)
{
return (bool) preg_match('#^(?:/|[a-zA-Z]:)#', $file);
}
}
}
namespace Symfony\Component\Config
{
interface FileLocatorInterface
{
public function locate($name, $currentPath = null, $first = true);
}
}
namespace Symfony\Bundle\FrameworkBundle\Templating\Loader
{
use Symfony\Component\Config\FileLocatorInterface;
use Symfony\Component\Templating\TemplateReferenceInterface;
class TemplateLocator implements FileLocatorInterface
{
protected $locator;
protected $cache;
public function __construct(FileLocatorInterface $locator, $cacheDir = null)
{
if (null !== $cacheDir && is_file($cache = $cacheDir.'/templates.php')) {
$this->cache = require $cache;
}
$this->locator = $locator;
}
protected function getCacheKey($template)
{
return $template->getLogicalName();
}
public function locate($template, $currentPath = null, $first = true)
{
if (!$template instanceof TemplateReferenceInterface) {
throw new \InvalidArgumentException('The template must be an instance of TemplateReferenceInterface.');
}
$key = $this->getCacheKey($template);
if (isset($this->cache[$key])) {
return $this->cache[$key];
}
try {
return $this->cache[$key] = $this->locator->locate($template->getPath(), $currentPath);
} catch (\InvalidArgumentException $e) {
throw new \InvalidArgumentException(sprintf('Unable to find template "%s" : "%s".', $template, $e->getMessage()), 0, $e);
}
}
}
}
namespace Symfony\Component\Routing
{
interface RequestContextAwareInterface
{
public function setContext(RequestContext $context);
public function getContext();
}
}
namespace Symfony\Component\Routing\Generator
{
use Symfony\Component\Routing\Exception\InvalidParameterException;
use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\Routing\RequestContextAwareInterface;
interface UrlGeneratorInterface extends RequestContextAwareInterface
{
const ABSOLUTE_URL = 0;
const ABSOLUTE_PATH = 1;
const RELATIVE_PATH = 2;
const NETWORK_PATH = 3;
public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH);
}
}
namespace Symfony\Component\Routing\Generator
{
interface ConfigurableRequirementsInterface
{
public function setStrictRequirements($enabled);
public function isStrictRequirements();
}
}
namespace Symfony\Component\Routing\Generator
{
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\InvalidParameterException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;
use Psr\Log\LoggerInterface;
class UrlGenerator implements UrlGeneratorInterface, ConfigurableRequirementsInterface
{
protected $routes;
protected $context;
protected $strictRequirements = true;
protected $logger;
protected $decodedChars = array('%2F'=>'/','%40'=>'@','%3A'=>':','%3B'=>';','%2C'=>',','%3D'=>'=','%2B'=>'+','%21'=>'!','%2A'=>'*','%7C'=>'|',
);
public function __construct(RouteCollection $routes, RequestContext $context, LoggerInterface $logger = null)
{
$this->routes = $routes;
$this->context = $context;
$this->logger = $logger;
}
public function setContext(RequestContext $context)
{
$this->context = $context;
}
public function getContext()
{
return $this->context;
}
public function setStrictRequirements($enabled)
{
$this->strictRequirements = null === $enabled ? null : (bool) $enabled;
}
public function isStrictRequirements()
{
return $this->strictRequirements;
}
public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH)
{
if (null === $route = $this->routes->get($name)) {
throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
}
$compiledRoute = $route->compile();
return $this->doGenerate($compiledRoute->getVariables(), $route->getDefaults(), $route->getRequirements(), $compiledRoute->getTokens(), $parameters, $name, $referenceType, $compiledRoute->getHostTokens(), $route->getSchemes());
}
protected function doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens, array $requiredSchemes = array())
{
if (is_bool($referenceType) || is_string($referenceType)) {
@trigger_error('The hardcoded value you are using for the $referenceType argument of the '.__CLASS__.'::generate method is deprecated since version 2.8 and will not be supported anymore in 3.0. Use the constants defined in the UrlGeneratorInterface instead.', E_USER_DEPRECATED);
if (true === $referenceType) {
$referenceType = self::ABSOLUTE_URL;
} elseif (false === $referenceType) {
$referenceType = self::ABSOLUTE_PATH;
} elseif ('relative'=== $referenceType) {
$referenceType = self::RELATIVE_PATH;
} elseif ('network'=== $referenceType) {
$referenceType = self::NETWORK_PATH;
}
}
$variables = array_flip($variables);
$mergedParams = array_replace($defaults, $this->context->getParameters(), $parameters);
if ($diff = array_diff_key($variables, $mergedParams)) {
throw new MissingMandatoryParametersException(sprintf('Some mandatory parameters are missing ("%s") to generate a URL for route "%s".', implode('", "', array_keys($diff)), $name));
}
$url ='';
$optional = true;
foreach ($tokens as $token) {
if ('variable'=== $token[0]) {
if (!$optional || !array_key_exists($token[3], $defaults) || null !== $mergedParams[$token[3]] && (string) $mergedParams[$token[3]] !== (string) $defaults[$token[3]]) {
if (null !== $this->strictRequirements && !preg_match('#^'.$token[2].'$#', $mergedParams[$token[3]])) {
$message = sprintf('Parameter "%s" for route "%s" must match "%s" ("%s" given) to generate a corresponding URL.', $token[3], $name, $token[2], $mergedParams[$token[3]]);
if ($this->strictRequirements) {
throw new InvalidParameterException($message);
}
if ($this->logger) {
$this->logger->error($message);
}
return;
}
$url = $token[1].$mergedParams[$token[3]].$url;
$optional = false;
}
} else {
$url = $token[1].$url;
$optional = false;
}
}
if (''=== $url) {
$url ='/';
}
$url = strtr(rawurlencode($url), $this->decodedChars);
$url = strtr($url, array('/../'=>'/%2E%2E/','/./'=>'/%2E/'));
if ('/..'=== substr($url, -3)) {
$url = substr($url, 0, -2).'%2E%2E';
} elseif ('/.'=== substr($url, -2)) {
$url = substr($url, 0, -1).'%2E';
}
$schemeAuthority ='';
if ($host = $this->context->getHost()) {
$scheme = $this->context->getScheme();
if ($requiredSchemes) {
if (!in_array($scheme, $requiredSchemes, true)) {
$referenceType = self::ABSOLUTE_URL;
$scheme = current($requiredSchemes);
}
} elseif (isset($requirements['_scheme']) && ($req = strtolower($requirements['_scheme'])) && $scheme !== $req) {
$referenceType = self::ABSOLUTE_URL;
$scheme = $req;
}
if ($hostTokens) {
$routeHost ='';
foreach ($hostTokens as $token) {
if ('variable'=== $token[0]) {
if (null !== $this->strictRequirements && !preg_match('#^'.$token[2].'$#i', $mergedParams[$token[3]])) {
$message = sprintf('Parameter "%s" for route "%s" must match "%s" ("%s" given) to generate a corresponding URL.', $token[3], $name, $token[2], $mergedParams[$token[3]]);
if ($this->strictRequirements) {
throw new InvalidParameterException($message);
}
if ($this->logger) {
$this->logger->error($message);
}
return;
}
$routeHost = $token[1].$mergedParams[$token[3]].$routeHost;
} else {
$routeHost = $token[1].$routeHost;
}
}
if ($routeHost !== $host) {
$host = $routeHost;
if (self::ABSOLUTE_URL !== $referenceType) {
$referenceType = self::NETWORK_PATH;
}
}
}
if (self::ABSOLUTE_URL === $referenceType || self::NETWORK_PATH === $referenceType) {
$port ='';
if ('http'=== $scheme && 80 != $this->context->getHttpPort()) {
$port =':'.$this->context->getHttpPort();
} elseif ('https'=== $scheme && 443 != $this->context->getHttpsPort()) {
$port =':'.$this->context->getHttpsPort();
}
$schemeAuthority = self::NETWORK_PATH === $referenceType ?'//': "$scheme://";
$schemeAuthority .= $host.$port;
}
}
if (self::RELATIVE_PATH === $referenceType) {
$url = self::getRelativePath($this->context->getPathInfo(), $url);
} else {
$url = $schemeAuthority.$this->context->getBaseUrl().$url;
}
$extra = array_udiff_assoc(array_diff_key($parameters, $variables), $defaults, function ($a, $b) {
return $a == $b ? 0 : 1;
});
if ($extra && $query = http_build_query($extra,'','&')) {
$url .='?'.strtr($query, array('%2F'=>'/'));
}
return $url;
}
public static function getRelativePath($basePath, $targetPath)
{
if ($basePath === $targetPath) {
return'';
}
$sourceDirs = explode('/', isset($basePath[0]) &&'/'=== $basePath[0] ? substr($basePath, 1) : $basePath);
$targetDirs = explode('/', isset($targetPath[0]) &&'/'=== $targetPath[0] ? substr($targetPath, 1) : $targetPath);
array_pop($sourceDirs);
$targetFile = array_pop($targetDirs);
foreach ($sourceDirs as $i => $dir) {
if (isset($targetDirs[$i]) && $dir === $targetDirs[$i]) {
unset($sourceDirs[$i], $targetDirs[$i]);
} else {
break;
}
}
$targetDirs[] = $targetFile;
$path = str_repeat('../', count($sourceDirs)).implode('/', $targetDirs);
return''=== $path ||'/'=== $path[0]
|| false !== ($colonPos = strpos($path,':')) && ($colonPos < ($slashPos = strpos($path,'/')) || false === $slashPos)
? "./$path" : $path;
}
}
}
namespace Symfony\Component\Routing
{
use Symfony\Component\HttpFoundation\Request;
class RequestContext
{
private $baseUrl;
private $pathInfo;
private $method;
private $host;
private $scheme;
private $httpPort;
private $httpsPort;
private $queryString;
private $parameters = array();
public function __construct($baseUrl ='', $method ='GET', $host ='localhost', $scheme ='http', $httpPort = 80, $httpsPort = 443, $path ='/', $queryString ='')
{
$this->setBaseUrl($baseUrl);
$this->setMethod($method);
$this->setHost($host);
$this->setScheme($scheme);
$this->setHttpPort($httpPort);
$this->setHttpsPort($httpsPort);
$this->setPathInfo($path);
$this->setQueryString($queryString);
}
public function fromRequest(Request $request)
{
$this->setBaseUrl($request->getBaseUrl());
$this->setPathInfo($request->getPathInfo());
$this->setMethod($request->getMethod());
$this->setHost($request->getHost());
$this->setScheme($request->getScheme());
$this->setHttpPort($request->isSecure() ? $this->httpPort : $request->getPort());
$this->setHttpsPort($request->isSecure() ? $request->getPort() : $this->httpsPort);
$this->setQueryString($request->server->get('QUERY_STRING',''));
return $this;
}
public function getBaseUrl()
{
return $this->baseUrl;
}
public function setBaseUrl($baseUrl)
{
$this->baseUrl = $baseUrl;
return $this;
}
public function getPathInfo()
{
return $this->pathInfo;
}
public function setPathInfo($pathInfo)
{
$this->pathInfo = $pathInfo;
return $this;
}
public function getMethod()
{
return $this->method;
}
public function setMethod($method)
{
$this->method = strtoupper($method);
return $this;
}
public function getHost()
{
return $this->host;
}
public function setHost($host)
{
$this->host = strtolower($host);
return $this;
}
public function getScheme()
{
return $this->scheme;
}
public function setScheme($scheme)
{
$this->scheme = strtolower($scheme);
return $this;
}
public function getHttpPort()
{
return $this->httpPort;
}
public function setHttpPort($httpPort)
{
$this->httpPort = (int) $httpPort;
return $this;
}
public function getHttpsPort()
{
return $this->httpsPort;
}
public function setHttpsPort($httpsPort)
{
$this->httpsPort = (int) $httpsPort;
return $this;
}
public function getQueryString()
{
return $this->queryString;
}
public function setQueryString($queryString)
{
$this->queryString = (string) $queryString;
return $this;
}
public function getParameters()
{
return $this->parameters;
}
public function setParameters(array $parameters)
{
$this->parameters = $parameters;
return $this;
}
public function getParameter($name)
{
return isset($this->parameters[$name]) ? $this->parameters[$name] : null;
}
public function hasParameter($name)
{
return array_key_exists($name, $this->parameters);
}
public function setParameter($name, $parameter)
{
$this->parameters[$name] = $parameter;
return $this;
}
}
}
namespace Symfony\Component\Routing\Matcher
{
use Symfony\Component\Routing\RequestContextAwareInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
interface UrlMatcherInterface extends RequestContextAwareInterface
{
public function match($pathinfo);
}
}
namespace Symfony\Component\Routing
{
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
interface RouterInterface extends UrlMatcherInterface, UrlGeneratorInterface
{
public function getRouteCollection();
}
}
namespace Symfony\Component\Routing\Matcher
{
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
interface RequestMatcherInterface
{
public function matchRequest(Request $request);
}
}
namespace Symfony\Component\Routing
{
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\ConfigCacheInterface;
use Symfony\Component\Config\ConfigCacheFactoryInterface;
use Symfony\Component\Config\ConfigCacheFactory;
use Psr\Log\LoggerInterface;
use Symfony\Component\Routing\Generator\ConfigurableRequirementsInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Generator\Dumper\GeneratorDumperInterface;
use Symfony\Component\Routing\Matcher\RequestMatcherInterface;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
use Symfony\Component\Routing\Matcher\Dumper\MatcherDumperInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\ExpressionLanguage\ExpressionFunctionProviderInterface;
class Router implements RouterInterface, RequestMatcherInterface
{
protected $matcher;
protected $generator;
protected $context;
protected $loader;
protected $collection;
protected $resource;
protected $options = array();
protected $logger;
private $configCacheFactory;
private $expressionLanguageProviders = array();
public function __construct(LoaderInterface $loader, $resource, array $options = array(), RequestContext $context = null, LoggerInterface $logger = null)
{
$this->loader = $loader;
$this->resource = $resource;
$this->logger = $logger;
$this->context = $context ?: new RequestContext();
$this->setOptions($options);
}
public function setOptions(array $options)
{
$this->options = array('cache_dir'=> null,'debug'=> false,'generator_class'=>'Symfony\\Component\\Routing\\Generator\\UrlGenerator','generator_base_class'=>'Symfony\\Component\\Routing\\Generator\\UrlGenerator','generator_dumper_class'=>'Symfony\\Component\\Routing\\Generator\\Dumper\\PhpGeneratorDumper','generator_cache_class'=>'ProjectUrlGenerator','matcher_class'=>'Symfony\\Component\\Routing\\Matcher\\UrlMatcher','matcher_base_class'=>'Symfony\\Component\\Routing\\Matcher\\UrlMatcher','matcher_dumper_class'=>'Symfony\\Component\\Routing\\Matcher\\Dumper\\PhpMatcherDumper','matcher_cache_class'=>'ProjectUrlMatcher','resource_type'=> null,'strict_requirements'=> true,
);
$invalid = array();
foreach ($options as $key => $value) {
if (array_key_exists($key, $this->options)) {
$this->options[$key] = $value;
} else {
$invalid[] = $key;
}
}
if ($invalid) {
throw new \InvalidArgumentException(sprintf('The Router does not support the following options: "%s".', implode('", "', $invalid)));
}
}
public function setOption($key, $value)
{
if (!array_key_exists($key, $this->options)) {
throw new \InvalidArgumentException(sprintf('The Router does not support the "%s" option.', $key));
}
$this->options[$key] = $value;
}
public function getOption($key)
{
if (!array_key_exists($key, $this->options)) {
throw new \InvalidArgumentException(sprintf('The Router does not support the "%s" option.', $key));
}
return $this->options[$key];
}
public function getRouteCollection()
{
if (null === $this->collection) {
$this->collection = $this->loader->load($this->resource, $this->options['resource_type']);
}
return $this->collection;
}
public function setContext(RequestContext $context)
{
$this->context = $context;
if (null !== $this->matcher) {
$this->getMatcher()->setContext($context);
}
if (null !== $this->generator) {
$this->getGenerator()->setContext($context);
}
}
public function getContext()
{
return $this->context;
}
public function setConfigCacheFactory(ConfigCacheFactoryInterface $configCacheFactory)
{
$this->configCacheFactory = $configCacheFactory;
}
public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH)
{
return $this->getGenerator()->generate($name, $parameters, $referenceType);
}
public function match($pathinfo)
{
return $this->getMatcher()->match($pathinfo);
}
public function matchRequest(Request $request)
{
$matcher = $this->getMatcher();
if (!$matcher instanceof RequestMatcherInterface) {
return $matcher->match($request->getPathInfo());
}
return $matcher->matchRequest($request);
}
public function getMatcher()
{
if (null !== $this->matcher) {
return $this->matcher;
}
if (null === $this->options['cache_dir'] || null === $this->options['matcher_cache_class']) {
$this->matcher = new $this->options['matcher_class']($this->getRouteCollection(), $this->context);
if (method_exists($this->matcher,'addExpressionLanguageProvider')) {
foreach ($this->expressionLanguageProviders as $provider) {
$this->matcher->addExpressionLanguageProvider($provider);
}
}
return $this->matcher;
}
$class = $this->options['matcher_cache_class'];
$baseClass = $this->options['matcher_base_class'];
$expressionLanguageProviders = $this->expressionLanguageProviders;
$that = $this;
$cache = $this->getConfigCacheFactory()->cache($this->options['cache_dir'].'/'.$class.'.php',
function (ConfigCacheInterface $cache) use ($that, $class, $baseClass, $expressionLanguageProviders) {
$dumper = $that->getMatcherDumperInstance();
if (method_exists($dumper,'addExpressionLanguageProvider')) {
foreach ($expressionLanguageProviders as $provider) {
$dumper->addExpressionLanguageProvider($provider);
}
}
$options = array('class'=> $class,'base_class'=> $baseClass,
);
$cache->write($dumper->dump($options), $that->getRouteCollection()->getResources());
}
);
require_once $cache->getPath();
return $this->matcher = new $class($this->context);
}
public function getGenerator()
{
if (null !== $this->generator) {
return $this->generator;
}
if (null === $this->options['cache_dir'] || null === $this->options['generator_cache_class']) {
$this->generator = new $this->options['generator_class']($this->getRouteCollection(), $this->context, $this->logger);
} else {
$class = $this->options['generator_cache_class'];
$baseClass = $this->options['generator_base_class'];
$that = $this; $cache = $this->getConfigCacheFactory()->cache($this->options['cache_dir'].'/'.$class.'.php',
function (ConfigCacheInterface $cache) use ($that, $class, $baseClass) {
$dumper = $that->getGeneratorDumperInstance();
$options = array('class'=> $class,'base_class'=> $baseClass,
);
$cache->write($dumper->dump($options), $that->getRouteCollection()->getResources());
}
);
require_once $cache->getPath();
$this->generator = new $class($this->context, $this->logger);
}
if ($this->generator instanceof ConfigurableRequirementsInterface) {
$this->generator->setStrictRequirements($this->options['strict_requirements']);
}
return $this->generator;
}
public function addExpressionLanguageProvider(ExpressionFunctionProviderInterface $provider)
{
$this->expressionLanguageProviders[] = $provider;
}
public function getGeneratorDumperInstance()
{
return new $this->options['generator_dumper_class']($this->getRouteCollection());
}
public function getMatcherDumperInstance()
{
return new $this->options['matcher_dumper_class']($this->getRouteCollection());
}
private function getConfigCacheFactory()
{
if (null === $this->configCacheFactory) {
$this->configCacheFactory = new ConfigCacheFactory($this->options['debug']);
}
return $this->configCacheFactory;
}
}
}
namespace Symfony\Component\Routing\Matcher
{
interface RedirectableUrlMatcherInterface
{
public function redirect($path, $route, $scheme = null);
}
}
namespace Symfony\Component\Routing\Matcher
{
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\ExpressionLanguage\ExpressionFunctionProviderInterface;
class UrlMatcher implements UrlMatcherInterface, RequestMatcherInterface
{
const REQUIREMENT_MATCH = 0;
const REQUIREMENT_MISMATCH = 1;
const ROUTE_MATCH = 2;
protected $context;
protected $allow = array();
protected $routes;
protected $request;
protected $expressionLanguage;
protected $expressionLanguageProviders = array();
public function __construct(RouteCollection $routes, RequestContext $context)
{
$this->routes = $routes;
$this->context = $context;
}
public function setContext(RequestContext $context)
{
$this->context = $context;
}
public function getContext()
{
return $this->context;
}
public function match($pathinfo)
{
$this->allow = array();
if ($ret = $this->matchCollection(rawurldecode($pathinfo), $this->routes)) {
return $ret;
}
throw 0 < count($this->allow)
? new MethodNotAllowedException(array_unique($this->allow))
: new ResourceNotFoundException(sprintf('No routes found for "%s".', $pathinfo));
}
public function matchRequest(Request $request)
{
$this->request = $request;
$ret = $this->match($request->getPathInfo());
$this->request = null;
return $ret;
}
public function addExpressionLanguageProvider(ExpressionFunctionProviderInterface $provider)
{
$this->expressionLanguageProviders[] = $provider;
}
protected function matchCollection($pathinfo, RouteCollection $routes)
{
foreach ($routes as $name => $route) {
$compiledRoute = $route->compile();
if (''!== $compiledRoute->getStaticPrefix() && 0 !== strpos($pathinfo, $compiledRoute->getStaticPrefix())) {
continue;
}
if (!preg_match($compiledRoute->getRegex(), $pathinfo, $matches)) {
continue;
}
$hostMatches = array();
if ($compiledRoute->getHostRegex() && !preg_match($compiledRoute->getHostRegex(), $this->context->getHost(), $hostMatches)) {
continue;
}
if ($requiredMethods = $route->getMethods()) {
if ('HEAD'=== $method = $this->context->getMethod()) {
$method ='GET';
}
if (!in_array($method, $requiredMethods)) {
$this->allow = array_merge($this->allow, $requiredMethods);
continue;
}
}
$status = $this->handleRouteRequirements($pathinfo, $name, $route);
if (self::ROUTE_MATCH === $status[0]) {
return $status[1];
}
if (self::REQUIREMENT_MISMATCH === $status[0]) {
continue;
}
return $this->getAttributes($route, $name, array_replace($matches, $hostMatches));
}
}
protected function getAttributes(Route $route, $name, array $attributes)
{
$attributes['_route'] = $name;
return $this->mergeDefaults($attributes, $route->getDefaults());
}
protected function handleRouteRequirements($pathinfo, $name, Route $route)
{
if ($route->getCondition() && !$this->getExpressionLanguage()->evaluate($route->getCondition(), array('context'=> $this->context,'request'=> $this->request))) {
return array(self::REQUIREMENT_MISMATCH, null);
}
$scheme = $this->context->getScheme();
$status = $route->getSchemes() && !$route->hasScheme($scheme) ? self::REQUIREMENT_MISMATCH : self::REQUIREMENT_MATCH;
return array($status, null);
}
protected function mergeDefaults($params, $defaults)
{
foreach ($params as $key => $value) {
if (!is_int($key)) {
$defaults[$key] = $value;
}
}
return $defaults;
}
protected function getExpressionLanguage()
{
if (null === $this->expressionLanguage) {
if (!class_exists('Symfony\Component\ExpressionLanguage\ExpressionLanguage')) {
throw new \RuntimeException('Unable to use expressions as the Symfony ExpressionLanguage component is not installed.');
}
$this->expressionLanguage = new ExpressionLanguage(null, $this->expressionLanguageProviders);
}
return $this->expressionLanguage;
}
}
}
namespace Symfony\Component\Routing\Matcher
{
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Route;
abstract class RedirectableUrlMatcher extends UrlMatcher implements RedirectableUrlMatcherInterface
{
public function match($pathinfo)
{
try {
$parameters = parent::match($pathinfo);
} catch (ResourceNotFoundException $e) {
if ('/'=== substr($pathinfo, -1) || !in_array($this->context->getMethod(), array('HEAD','GET'))) {
throw $e;
}
try {
parent::match($pathinfo.'/');
return $this->redirect($pathinfo.'/', null);
} catch (ResourceNotFoundException $e2) {
throw $e;
}
}
return $parameters;
}
protected function handleRouteRequirements($pathinfo, $name, Route $route)
{
if ($route->getCondition() && !$this->getExpressionLanguage()->evaluate($route->getCondition(), array('context'=> $this->context,'request'=> $this->request))) {
return array(self::REQUIREMENT_MISMATCH, null);
}
$scheme = $this->context->getScheme();
$schemes = $route->getSchemes();
if ($schemes && !$route->hasScheme($scheme)) {
return array(self::ROUTE_MATCH, $this->redirect($pathinfo, $name, current($schemes)));
}
return array(self::REQUIREMENT_MATCH, null);
}
}
}
namespace Symfony\Bundle\FrameworkBundle\Routing
{
use Symfony\Component\Routing\Matcher\RedirectableUrlMatcher as BaseMatcher;
class RedirectableUrlMatcher extends BaseMatcher
{
public function redirect($path, $route, $scheme = null)
{
return array('_controller'=>'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController::urlRedirectAction','path'=> $path,'permanent'=> true,'scheme'=> $scheme,'httpPort'=> $this->context->getHttpPort(),'httpsPort'=> $this->context->getHttpsPort(),'_route'=> $route,
);
}
}
}
namespace Symfony\Component\HttpKernel\CacheWarmer
{
interface WarmableInterface
{
public function warmUp($cacheDir);
}
}
namespace Symfony\Bundle\FrameworkBundle\Routing
{
use Symfony\Component\Routing\Router as BaseRouter;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\HttpKernel\CacheWarmer\WarmableInterface;
use Symfony\Component\DependencyInjection\Exception\ParameterNotFoundException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
class Router extends BaseRouter implements WarmableInterface
{
private $container;
public function __construct(ContainerInterface $container, $resource, array $options = array(), RequestContext $context = null)
{
$this->container = $container;
$this->resource = $resource;
$this->context = $context ?: new RequestContext();
$this->setOptions($options);
}
public function getRouteCollection()
{
if (null === $this->collection) {
$this->collection = $this->container->get('routing.loader')->load($this->resource, $this->options['resource_type']);
$this->resolveParameters($this->collection);
}
return $this->collection;
}
public function warmUp($cacheDir)
{
$currentDir = $this->getOption('cache_dir');
$this->setOption('cache_dir', $cacheDir);
$this->getMatcher();
$this->getGenerator();
$this->setOption('cache_dir', $currentDir);
}
private function resolveParameters(RouteCollection $collection)
{
foreach ($collection as $route) {
foreach ($route->getDefaults() as $name => $value) {
$route->setDefault($name, $this->resolve($value));
}
foreach ($route->getRequirements() as $name => $value) {
if ('_scheme'=== $name ||'_method'=== $name) {
continue; }
$route->setRequirement($name, $this->resolve($value));
}
$route->setPath($this->resolve($route->getPath()));
$route->setHost($this->resolve($route->getHost()));
$schemes = array();
foreach ($route->getSchemes() as $scheme) {
$schemes = array_merge($schemes, explode('|', $this->resolve($scheme)));
}
$route->setSchemes($schemes);
$methods = array();
foreach ($route->getMethods() as $method) {
$methods = array_merge($methods, explode('|', $this->resolve($method)));
}
$route->setMethods($methods);
$route->setCondition($this->resolve($route->getCondition()));
}
}
private function resolve($value)
{
if (is_array($value)) {
foreach ($value as $key => $val) {
$value[$key] = $this->resolve($val);
}
return $value;
}
if (!is_string($value)) {
return $value;
}
$container = $this->container;
$escapedValue = preg_replace_callback('/%%|%([^%\s]++)%/', function ($match) use ($container, $value) {
if (!isset($match[1])) {
return'%%';
}
$resolved = $container->getParameter($match[1]);
if (is_string($resolved) || is_numeric($resolved)) {
return (string) $resolved;
}
throw new RuntimeException(sprintf('The container parameter "%s", used in the route configuration value "%s", '.'must be a string or numeric, but it is of type %s.',
$match[1],
$value,
gettype($resolved)
)
);
}, $value);
return str_replace('%%','%', $escapedValue);
}
}
}
namespace Symfony\Component\Config
{
class FileLocator implements FileLocatorInterface
{
protected $paths;
public function __construct($paths = array())
{
$this->paths = (array) $paths;
}
public function locate($name, $currentPath = null, $first = true)
{
if (''== $name) {
throw new \InvalidArgumentException('An empty file name is not valid to be located.');
}
if ($this->isAbsolutePath($name)) {
if (!file_exists($name)) {
throw new \InvalidArgumentException(sprintf('The file "%s" does not exist.', $name));
}
return $name;
}
$paths = $this->paths;
if (null !== $currentPath) {
array_unshift($paths, $currentPath);
}
$paths = array_unique($paths);
$filepaths = array();
foreach ($paths as $path) {
if (file_exists($file = $path.DIRECTORY_SEPARATOR.$name)) {
if (true === $first) {
return $file;
}
$filepaths[] = $file;
}
}
if (!$filepaths) {
throw new \InvalidArgumentException(sprintf('The file "%s" does not exist (in: %s).', $name, implode(', ', $paths)));
}
return $filepaths;
}
private function isAbsolutePath($file)
{
if ($file[0] ==='/'|| $file[0] ==='\\'|| (strlen($file) > 3 && ctype_alpha($file[0])
&& $file[1] ===':'&& ($file[2] ==='\\'|| $file[2] ==='/')
)
|| null !== parse_url($file, PHP_URL_SCHEME)
) {
return true;
}
return false;
}
}
}
namespace Symfony\Component\EventDispatcher
{
class Event
{
private $propagationStopped = false;
private $dispatcher;
private $name;
public function isPropagationStopped()
{
return $this->propagationStopped;
}
public function stopPropagation()
{
$this->propagationStopped = true;
}
public function setDispatcher(EventDispatcherInterface $dispatcher)
{
$this->dispatcher = $dispatcher;
}
public function getDispatcher()
{
@trigger_error('The '.__METHOD__.' method is deprecated since version 2.4 and will be removed in 3.0. The event dispatcher instance can be received in the listener call instead.', E_USER_DEPRECATED);
return $this->dispatcher;
}
public function getName()
{
@trigger_error('The '.__METHOD__.' method is deprecated since version 2.4 and will be removed in 3.0. The event name can be received in the listener call instead.', E_USER_DEPRECATED);
return $this->name;
}
public function setName($name)
{
$this->name = $name;
}
}
}
namespace Symfony\Component\EventDispatcher
{
interface EventDispatcherInterface
{
public function dispatch($eventName, Event $event = null);
public function addListener($eventName, $listener, $priority = 0);
public function addSubscriber(EventSubscriberInterface $subscriber);
public function removeListener($eventName, $listener);
public function removeSubscriber(EventSubscriberInterface $subscriber);
public function getListeners($eventName = null);
public function hasListeners($eventName = null);
}
}
namespace Symfony\Component\EventDispatcher
{
class EventDispatcher implements EventDispatcherInterface
{
private $listeners = array();
private $sorted = array();
public function dispatch($eventName, Event $event = null)
{
if (null === $event) {
$event = new Event();
}
$event->setDispatcher($this);
$event->setName($eventName);
if ($listeners = $this->getListeners($eventName)) {
$this->doDispatch($listeners, $eventName, $event);
}
return $event;
}
public function getListeners($eventName = null)
{
if (null !== $eventName) {
if (!isset($this->listeners[$eventName])) {
return array();
}
if (!isset($this->sorted[$eventName])) {
$this->sortListeners($eventName);
}
return $this->sorted[$eventName];
}
foreach ($this->listeners as $eventName => $eventListeners) {
if (!isset($this->sorted[$eventName])) {
$this->sortListeners($eventName);
}
}
return array_filter($this->sorted);
}
public function getListenerPriority($eventName, $listener)
{
if (!isset($this->listeners[$eventName])) {
return;
}
foreach ($this->listeners[$eventName] as $priority => $listeners) {
if (false !== ($key = array_search($listener, $listeners, true))) {
return $priority;
}
}
}
public function hasListeners($eventName = null)
{
return (bool) count($this->getListeners($eventName));
}
public function addListener($eventName, $listener, $priority = 0)
{
$this->listeners[$eventName][$priority][] = $listener;
unset($this->sorted[$eventName]);
}
public function removeListener($eventName, $listener)
{
if (!isset($this->listeners[$eventName])) {
return;
}
foreach ($this->listeners[$eventName] as $priority => $listeners) {
if (false !== ($key = array_search($listener, $listeners, true))) {
unset($this->listeners[$eventName][$priority][$key], $this->sorted[$eventName]);
}
}
}
public function addSubscriber(EventSubscriberInterface $subscriber)
{
foreach ($subscriber->getSubscribedEvents() as $eventName => $params) {
if (is_string($params)) {
$this->addListener($eventName, array($subscriber, $params));
} elseif (is_string($params[0])) {
$this->addListener($eventName, array($subscriber, $params[0]), isset($params[1]) ? $params[1] : 0);
} else {
foreach ($params as $listener) {
$this->addListener($eventName, array($subscriber, $listener[0]), isset($listener[1]) ? $listener[1] : 0);
}
}
}
}
public function removeSubscriber(EventSubscriberInterface $subscriber)
{
foreach ($subscriber->getSubscribedEvents() as $eventName => $params) {
if (is_array($params) && is_array($params[0])) {
foreach ($params as $listener) {
$this->removeListener($eventName, array($subscriber, $listener[0]));
}
} else {
$this->removeListener($eventName, array($subscriber, is_string($params) ? $params : $params[0]));
}
}
}
protected function doDispatch($listeners, $eventName, Event $event)
{
foreach ($listeners as $listener) {
if ($event->isPropagationStopped()) {
break;
}
call_user_func($listener, $event, $eventName, $this);
}
}
private function sortListeners($eventName)
{
krsort($this->listeners[$eventName]);
$this->sorted[$eventName] = call_user_func_array('array_merge', $this->listeners[$eventName]);
}
}
}
namespace Symfony\Component\EventDispatcher
{
use Symfony\Component\DependencyInjection\ContainerInterface;
class ContainerAwareEventDispatcher extends EventDispatcher
{
private $container;
private $listenerIds = array();
private $listeners = array();
public function __construct(ContainerInterface $container)
{
$this->container = $container;
}
public function addListenerService($eventName, $callback, $priority = 0)
{
if (!is_array($callback) || 2 !== count($callback)) {
throw new \InvalidArgumentException('Expected an array("service", "method") argument');
}
$this->listenerIds[$eventName][] = array($callback[0], $callback[1], $priority);
}
public function removeListener($eventName, $listener)
{
$this->lazyLoad($eventName);
if (isset($this->listenerIds[$eventName])) {
foreach ($this->listenerIds[$eventName] as $i => $args) {
list($serviceId, $method, $priority) = $args;
$key = $serviceId.'.'.$method;
if (isset($this->listeners[$eventName][$key]) && $listener === array($this->listeners[$eventName][$key], $method)) {
unset($this->listeners[$eventName][$key]);
if (empty($this->listeners[$eventName])) {
unset($this->listeners[$eventName]);
}
unset($this->listenerIds[$eventName][$i]);
if (empty($this->listenerIds[$eventName])) {
unset($this->listenerIds[$eventName]);
}
}
}
}
parent::removeListener($eventName, $listener);
}
public function hasListeners($eventName = null)
{
if (null === $eventName) {
return (bool) count($this->listenerIds) || (bool) count($this->listeners);
}
if (isset($this->listenerIds[$eventName])) {
return true;
}
return parent::hasListeners($eventName);
}
public function getListeners($eventName = null)
{
if (null === $eventName) {
foreach ($this->listenerIds as $serviceEventName => $args) {
$this->lazyLoad($serviceEventName);
}
} else {
$this->lazyLoad($eventName);
}
return parent::getListeners($eventName);
}
public function getListenerPriority($eventName, $listener)
{
$this->lazyLoad($eventName);
return parent::getListenerPriority($eventName, $listener);
}
public function addSubscriberService($serviceId, $class)
{
foreach ($class::getSubscribedEvents() as $eventName => $params) {
if (is_string($params)) {
$this->listenerIds[$eventName][] = array($serviceId, $params, 0);
} elseif (is_string($params[0])) {
$this->listenerIds[$eventName][] = array($serviceId, $params[0], isset($params[1]) ? $params[1] : 0);
} else {
foreach ($params as $listener) {
$this->listenerIds[$eventName][] = array($serviceId, $listener[0], isset($listener[1]) ? $listener[1] : 0);
}
}
}
}
public function getContainer()
{
return $this->container;
}
protected function lazyLoad($eventName)
{
if (isset($this->listenerIds[$eventName])) {
foreach ($this->listenerIds[$eventName] as $args) {
list($serviceId, $method, $priority) = $args;
$listener = $this->container->get($serviceId);
$key = $serviceId.'.'.$method;
if (!isset($this->listeners[$eventName][$key])) {
$this->addListener($eventName, array($listener, $method), $priority);
} elseif ($listener !== $this->listeners[$eventName][$key]) {
parent::removeListener($eventName, array($this->listeners[$eventName][$key], $method));
$this->addListener($eventName, array($listener, $method), $priority);
}
$this->listeners[$eventName][$key] = $listener;
}
}
}
}
}
namespace Symfony\Component\HttpKernel\EventListener
{
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
class ResponseListener implements EventSubscriberInterface
{
private $charset;
public function __construct($charset)
{
$this->charset = $charset;
}
public function onKernelResponse(FilterResponseEvent $event)
{
if (!$event->isMasterRequest()) {
return;
}
$response = $event->getResponse();
if (null === $response->getCharset()) {
$response->setCharset($this->charset);
}
$response->prepare($event->getRequest());
}
public static function getSubscribedEvents()
{
return array(
KernelEvents::RESPONSE =>'onKernelResponse',
);
}
}
}
namespace Symfony\Component\HttpKernel\EventListener
{
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\FinishRequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
use Symfony\Component\Routing\Matcher\RequestMatcherInterface;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RequestContextAwareInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
class RouterListener implements EventSubscriberInterface
{
private $matcher;
private $context;
private $logger;
private $request;
private $requestStack;
public function __construct($matcher, $requestStack = null, $context = null, $logger = null)
{
if ($requestStack instanceof RequestContext || $context instanceof LoggerInterface || $logger instanceof RequestStack) {
$tmp = $requestStack;
$requestStack = $logger;
$logger = $context;
$context = $tmp;
@trigger_error('The '.__METHOD__.' method now requires a RequestStack to be given as second argument as '.__CLASS__.'::setRequest method will not be supported anymore in 3.0.', E_USER_DEPRECATED);
} elseif (!$requestStack instanceof RequestStack) {
@trigger_error('The '.__METHOD__.' method now requires a RequestStack instance as '.__CLASS__.'::setRequest method will not be supported anymore in 3.0.', E_USER_DEPRECATED);
}
if (null !== $requestStack && !$requestStack instanceof RequestStack) {
throw new \InvalidArgumentException('RequestStack instance expected.');
}
if (null !== $context && !$context instanceof RequestContext) {
throw new \InvalidArgumentException('RequestContext instance expected.');
}
if (null !== $logger && !$logger instanceof LoggerInterface) {
throw new \InvalidArgumentException('Logger must implement LoggerInterface.');
}
if (!$matcher instanceof UrlMatcherInterface && !$matcher instanceof RequestMatcherInterface) {
throw new \InvalidArgumentException('Matcher must either implement UrlMatcherInterface or RequestMatcherInterface.');
}
if (null === $context && !$matcher instanceof RequestContextAwareInterface) {
throw new \InvalidArgumentException('You must either pass a RequestContext or the matcher must implement RequestContextAwareInterface.');
}
$this->matcher = $matcher;
$this->context = $context ?: $matcher->getContext();
$this->requestStack = $requestStack;
$this->logger = $logger;
}
public function setRequest(Request $request = null)
{
@trigger_error('The '.__METHOD__.' method is deprecated since version 2.4 and will be made private in 3.0.', E_USER_DEPRECATED);
$this->setCurrentRequest($request);
}
private function setCurrentRequest(Request $request = null)
{
if (null !== $request && $this->request !== $request) {
$this->context->fromRequest($request);
}
$this->request = $request;
}
public function onKernelFinishRequest(FinishRequestEvent $event)
{
if (null === $this->requestStack) {
return; }
$this->setCurrentRequest($this->requestStack->getParentRequest());
}
public function onKernelRequest(GetResponseEvent $event)
{
$request = $event->getRequest();
if (null !== $this->requestStack) {
$this->setCurrentRequest($request);
}
if ($request->attributes->has('_controller')) {
return;
}
try {
if ($this->matcher instanceof RequestMatcherInterface) {
$parameters = $this->matcher->matchRequest($request);
} else {
$parameters = $this->matcher->match($request->getPathInfo());
}
if (null !== $this->logger) {
$this->logger->info(sprintf('Matched route "%s".', isset($parameters['_route']) ? $parameters['_route'] :'n/a'), array('route_parameters'=> $parameters,'request_uri'=> $request->getUri(),
));
}
$request->attributes->add($parameters);
unset($parameters['_route'], $parameters['_controller']);
$request->attributes->set('_route_params', $parameters);
} catch (ResourceNotFoundException $e) {
$message = sprintf('No route found for "%s %s"', $request->getMethod(), $request->getPathInfo());
if ($referer = $request->headers->get('referer')) {
$message .= sprintf(' (from "%s")', $referer);
}
throw new NotFoundHttpException($message, $e);
} catch (MethodNotAllowedException $e) {
$message = sprintf('No route found for "%s %s": Method Not Allowed (Allow: %s)', $request->getMethod(), $request->getPathInfo(), implode(', ', $e->getAllowedMethods()));
throw new MethodNotAllowedHttpException($e->getAllowedMethods(), $message, $e);
}
}
public static function getSubscribedEvents()
{
return array(
KernelEvents::REQUEST => array(array('onKernelRequest', 32)),
KernelEvents::FINISH_REQUEST => array(array('onKernelFinishRequest', 0)),
);
}
}
}
namespace Symfony\Component\HttpKernel\Controller
{
use Symfony\Component\HttpFoundation\Request;
interface ControllerResolverInterface
{
public function getController(Request $request);
public function getArguments(Request $request, $controller);
}
}
namespace Symfony\Component\HttpKernel\Controller
{
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
class ControllerResolver implements ControllerResolverInterface
{
private $logger;
public function __construct(LoggerInterface $logger = null)
{
$this->logger = $logger;
}
public function getController(Request $request)
{
if (!$controller = $request->attributes->get('_controller')) {
if (null !== $this->logger) {
$this->logger->warning('Unable to look for the controller as the "_controller" parameter is missing.');
}
return false;
}
if (is_array($controller)) {
return $controller;
}
if (is_object($controller)) {
if (method_exists($controller,'__invoke')) {
return $controller;
}
throw new \InvalidArgumentException(sprintf('Controller "%s" for URI "%s" is not callable.', get_class($controller), $request->getPathInfo()));
}
if (false === strpos($controller,':')) {
if (method_exists($controller,'__invoke')) {
return $this->instantiateController($controller);
} elseif (function_exists($controller)) {
return $controller;
}
}
$callable = $this->createController($controller);
if (!is_callable($callable)) {
throw new \InvalidArgumentException(sprintf('Controller "%s" for URI "%s" is not callable.', $controller, $request->getPathInfo()));
}
return $callable;
}
public function getArguments(Request $request, $controller)
{
if (is_array($controller)) {
$r = new \ReflectionMethod($controller[0], $controller[1]);
} elseif (is_object($controller) && !$controller instanceof \Closure) {
$r = new \ReflectionObject($controller);
$r = $r->getMethod('__invoke');
} else {
$r = new \ReflectionFunction($controller);
}
return $this->doGetArguments($request, $controller, $r->getParameters());
}
protected function doGetArguments(Request $request, $controller, array $parameters)
{
$attributes = $request->attributes->all();
$arguments = array();
foreach ($parameters as $param) {
if (array_key_exists($param->name, $attributes)) {
if (PHP_VERSION_ID >= 50600 && $param->isVariadic() && is_array($attributes[$param->name])) {
$arguments = array_merge($arguments, array_values($attributes[$param->name]));
} else {
$arguments[] = $attributes[$param->name];
}
} elseif ($param->getClass() && $param->getClass()->isInstance($request)) {
$arguments[] = $request;
} elseif ($param->isDefaultValueAvailable()) {
$arguments[] = $param->getDefaultValue();
} else {
if (is_array($controller)) {
$repr = sprintf('%s::%s()', get_class($controller[0]), $controller[1]);
} elseif (is_object($controller)) {
$repr = get_class($controller);
} else {
$repr = $controller;
}
throw new \RuntimeException(sprintf('Controller "%s" requires that you provide a value for the "$%s" argument (because there is no default value or because there is a non optional argument after this one).', $repr, $param->name));
}
}
return $arguments;
}
protected function createController($controller)
{
if (false === strpos($controller,'::')) {
throw new \InvalidArgumentException(sprintf('Unable to find controller "%s".', $controller));
}
list($class, $method) = explode('::', $controller, 2);
if (!class_exists($class)) {
throw new \InvalidArgumentException(sprintf('Class "%s" does not exist.', $class));
}
return array($this->instantiateController($class), $method);
}
protected function instantiateController($class)
{
return new $class();
}
}
}
namespace Symfony\Component\HttpKernel\Event
{
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\EventDispatcher\Event;
class KernelEvent extends Event
{
private $kernel;
private $request;
private $requestType;
public function __construct(HttpKernelInterface $kernel, Request $request, $requestType)
{
$this->kernel = $kernel;
$this->request = $request;
$this->requestType = $requestType;
}
public function getKernel()
{
return $this->kernel;
}
public function getRequest()
{
return $this->request;
}
public function getRequestType()
{
return $this->requestType;
}
public function isMasterRequest()
{
return HttpKernelInterface::MASTER_REQUEST === $this->requestType;
}
}
}
namespace Symfony\Component\HttpKernel\Event
{
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Request;
class FilterControllerEvent extends KernelEvent
{
private $controller;
public function __construct(HttpKernelInterface $kernel, $controller, Request $request, $requestType)
{
parent::__construct($kernel, $request, $requestType);
$this->setController($controller);
}
public function getController()
{
return $this->controller;
}
public function setController($controller)
{
if (!is_callable($controller)) {
throw new \LogicException(sprintf('The controller must be a callable (%s given).', $this->varToString($controller)));
}
$this->controller = $controller;
}
private function varToString($var)
{
if (is_object($var)) {
return sprintf('Object(%s)', get_class($var));
}
if (is_array($var)) {
$a = array();
foreach ($var as $k => $v) {
$a[] = sprintf('%s => %s', $k, $this->varToString($v));
}
return sprintf('Array(%s)', implode(', ', $a));
}
if (is_resource($var)) {
return sprintf('Resource(%s)', get_resource_type($var));
}
if (null === $var) {
return'null';
}
if (false === $var) {
return'false';
}
if (true === $var) {
return'true';
}
return (string) $var;
}
}
}
namespace Symfony\Component\HttpKernel\Event
{
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
class FilterResponseEvent extends KernelEvent
{
private $response;
public function __construct(HttpKernelInterface $kernel, Request $request, $requestType, Response $response)
{
parent::__construct($kernel, $request, $requestType);
$this->setResponse($response);
}
public function getResponse()
{
return $this->response;
}
public function setResponse(Response $response)
{
$this->response = $response;
}
}
}
namespace Symfony\Component\HttpKernel\Event
{
use Symfony\Component\HttpFoundation\Response;
class GetResponseEvent extends KernelEvent
{
private $response;
public function getResponse()
{
return $this->response;
}
public function setResponse(Response $response)
{
$this->response = $response;
$this->stopPropagation();
}
public function hasResponse()
{
return null !== $this->response;
}
}
}
namespace Symfony\Component\HttpKernel\Event
{
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Request;
class GetResponseForControllerResultEvent extends GetResponseEvent
{
private $controllerResult;
public function __construct(HttpKernelInterface $kernel, Request $request, $requestType, $controllerResult)
{
parent::__construct($kernel, $request, $requestType);
$this->controllerResult = $controllerResult;
}
public function getControllerResult()
{
return $this->controllerResult;
}
public function setControllerResult($controllerResult)
{
$this->controllerResult = $controllerResult;
}
}
}
namespace Symfony\Component\HttpKernel\Event
{
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Request;
class GetResponseForExceptionEvent extends GetResponseEvent
{
private $exception;
public function __construct(HttpKernelInterface $kernel, Request $request, $requestType, \Exception $e)
{
parent::__construct($kernel, $request, $requestType);
$this->setException($e);
}
public function getException()
{
return $this->exception;
}
public function setException(\Exception $exception)
{
$this->exception = $exception;
}
}
}
namespace Symfony\Component\HttpKernel
{
final class KernelEvents
{
const REQUEST ='kernel.request';
const EXCEPTION ='kernel.exception';
const VIEW ='kernel.view';
const CONTROLLER ='kernel.controller';
const RESPONSE ='kernel.response';
const TERMINATE ='kernel.terminate';
const FINISH_REQUEST ='kernel.finish_request';
}
}
namespace Symfony\Component\HttpKernel\Config
{
use Symfony\Component\Config\FileLocator as BaseFileLocator;
use Symfony\Component\HttpKernel\KernelInterface;
class FileLocator extends BaseFileLocator
{
private $kernel;
private $path;
public function __construct(KernelInterface $kernel, $path = null, array $paths = array())
{
$this->kernel = $kernel;
if (null !== $path) {
$this->path = $path;
$paths[] = $path;
}
parent::__construct($paths);
}
public function locate($file, $currentPath = null, $first = true)
{
if (isset($file[0]) &&'@'=== $file[0]) {
return $this->kernel->locateResource($file, $this->path, $first);
}
return parent::locate($file, $currentPath, $first);
}
}
}
namespace Symfony\Bundle\FrameworkBundle\Controller
{
use Symfony\Component\HttpKernel\KernelInterface;
class ControllerNameParser
{
protected $kernel;
public function __construct(KernelInterface $kernel)
{
$this->kernel = $kernel;
}
public function parse($controller)
{
$originalController = $controller;
if (3 !== count($parts = explode(':', $controller))) {
throw new \InvalidArgumentException(sprintf('The "%s" controller is not a valid "a:b:c" controller string.', $controller));
}
list($bundle, $controller, $action) = $parts;
$controller = str_replace('/','\\', $controller);
$bundles = array();
try {
$allBundles = $this->kernel->getBundle($bundle, false);
} catch (\InvalidArgumentException $e) {
$message = sprintf('The "%s" (from the _controller value "%s") does not exist or is not enabled in your kernel!',
$bundle,
$originalController
);
if ($alternative = $this->findAlternative($bundle)) {
$message .= sprintf(' Did you mean "%s:%s:%s"?', $alternative, $controller, $action);
}
throw new \InvalidArgumentException($message, 0, $e);
}
foreach ($allBundles as $b) {
$try = $b->getNamespace().'\\Controller\\'.$controller.'Controller';
if (class_exists($try)) {
return $try.'::'.$action.'Action';
}
$bundles[] = $b->getName();
$msg = sprintf('The _controller value "%s:%s:%s" maps to a "%s" class, but this class was not found. Create this class or check the spelling of the class and its namespace.', $bundle, $controller, $action, $try);
}
if (count($bundles) > 1) {
$msg = sprintf('Unable to find controller "%s:%s" in bundles %s.', $bundle, $controller, implode(', ', $bundles));
}
throw new \InvalidArgumentException($msg);
}
public function build($controller)
{
if (0 === preg_match('#^(.*?\\\\Controller\\\\(.+)Controller)::(.+)Action$#', $controller, $match)) {
throw new \InvalidArgumentException(sprintf('The "%s" controller is not a valid "class::method" string.', $controller));
}
$className = $match[1];
$controllerName = $match[2];
$actionName = $match[3];
foreach ($this->kernel->getBundles() as $name => $bundle) {
if (0 !== strpos($className, $bundle->getNamespace())) {
continue;
}
return sprintf('%s:%s:%s', $name, $controllerName, $actionName);
}
throw new \InvalidArgumentException(sprintf('Unable to find a bundle that defines controller "%s".', $controller));
}
private function findAlternative($nonExistentBundleName)
{
$bundleNames = array_map(function ($b) {
return $b->getName();
}, $this->kernel->getBundles());
$alternative = null;
$shortest = null;
foreach ($bundleNames as $bundleName) {
if (false !== strpos($bundleName, $nonExistentBundleName)) {
return $bundleName;
}
$lev = levenshtein($nonExistentBundleName, $bundleName);
if ($lev <= strlen($nonExistentBundleName) / 3 && ($alternative === null || $lev < $shortest)) {
$alternative = $bundleName;
$shortest = $lev;
}
}
return $alternative;
}
}
}
namespace Symfony\Bundle\FrameworkBundle\Controller
{
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Controller\ControllerResolver as BaseControllerResolver;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
class ControllerResolver extends BaseControllerResolver
{
protected $container;
protected $parser;
public function __construct(ContainerInterface $container, ControllerNameParser $parser, LoggerInterface $logger = null)
{
$this->container = $container;
$this->parser = $parser;
parent::__construct($logger);
}
protected function createController($controller)
{
if (false === strpos($controller,'::')) {
$count = substr_count($controller,':');
if (2 == $count) {
$controller = $this->parser->parse($controller);
} elseif (1 == $count) {
list($service, $method) = explode(':', $controller, 2);
return array($this->container->get($service), $method);
} elseif ($this->container->has($controller) && method_exists($service = $this->container->get($controller),'__invoke')) {
return $service;
} else {
throw new \LogicException(sprintf('Unable to parse the controller name "%s".', $controller));
}
}
return parent::createController($controller);
}
protected function instantiateController($class)
{
if ($this->container->has($class)) {
return $this->container->get($class);
}
$controller = parent::instantiateController($class);
if ($controller instanceof ContainerAwareInterface) {
$controller->setContainer($this->container);
}
return $controller;
}
}
}
namespace Symfony\Component\Security\Http
{
use Symfony\Component\HttpFoundation\Request;
interface AccessMapInterface
{
public function getPatterns(Request $request);
}
}
namespace Symfony\Component\Security\Http
{
use Symfony\Component\HttpFoundation\RequestMatcherInterface;
use Symfony\Component\HttpFoundation\Request;
class AccessMap implements AccessMapInterface
{
private $map = array();
public function add(RequestMatcherInterface $requestMatcher, array $attributes = array(), $channel = null)
{
$this->map[] = array($requestMatcher, $attributes, $channel);
}
public function getPatterns(Request $request)
{
foreach ($this->map as $elements) {
if (null === $elements[0] || $elements[0]->matches($request)) {
return array($elements[1], $elements[2]);
}
}
return array(null, null);
}
}
}
namespace Symfony\Component\Security\Http
{
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\FinishRequestEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
class Firewall implements EventSubscriberInterface
{
private $map;
private $dispatcher;
private $exceptionListeners;
public function __construct(FirewallMapInterface $map, EventDispatcherInterface $dispatcher)
{
$this->map = $map;
$this->dispatcher = $dispatcher;
$this->exceptionListeners = new \SplObjectStorage();
}
public function onKernelRequest(GetResponseEvent $event)
{
if (!$event->isMasterRequest()) {
return;
}
list($listeners, $exceptionListener) = $this->map->getListeners($event->getRequest());
if (null !== $exceptionListener) {
$this->exceptionListeners[$event->getRequest()] = $exceptionListener;
$exceptionListener->register($this->dispatcher);
}
foreach ($listeners as $listener) {
$listener->handle($event);
if ($event->hasResponse()) {
break;
}
}
}
public function onKernelFinishRequest(FinishRequestEvent $event)
{
$request = $event->getRequest();
if (isset($this->exceptionListeners[$request])) {
$this->exceptionListeners[$request]->unregister($this->dispatcher);
unset($this->exceptionListeners[$request]);
}
}
public static function getSubscribedEvents()
{
return array(
KernelEvents::REQUEST => array('onKernelRequest', 8),
KernelEvents::FINISH_REQUEST =>'onKernelFinishRequest',
);
}
}
}
namespace Symfony\Component\Security\Core\User
{
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
interface UserProviderInterface
{
public function loadUserByUsername($username);
public function refreshUser(UserInterface $user);
public function supportsClass($class);
}
}
namespace Symfony\Component\Security\Core\Authentication
{
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
interface AuthenticationManagerInterface
{
public function authenticate(TokenInterface $token);
}
}
namespace Symfony\Component\Security\Core\Authentication
{
use Symfony\Component\Security\Core\Event\AuthenticationFailureEvent;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Exception\AccountStatusException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\ProviderNotFoundException;
use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
class AuthenticationProviderManager implements AuthenticationManagerInterface
{
private $providers;
private $eraseCredentials;
private $eventDispatcher;
public function __construct(array $providers, $eraseCredentials = true)
{
if (!$providers) {
throw new \InvalidArgumentException('You must at least add one authentication provider.');
}
foreach ($providers as $provider) {
if (!$provider instanceof AuthenticationProviderInterface) {
throw new \InvalidArgumentException(sprintf('Provider "%s" must implement the AuthenticationProviderInterface.', get_class($provider)));
}
}
$this->providers = $providers;
$this->eraseCredentials = (bool) $eraseCredentials;
}
public function setEventDispatcher(EventDispatcherInterface $dispatcher)
{
$this->eventDispatcher = $dispatcher;
}
public function authenticate(TokenInterface $token)
{
$lastException = null;
$result = null;
foreach ($this->providers as $provider) {
if (!$provider->supports($token)) {
continue;
}
try {
$result = $provider->authenticate($token);
if (null !== $result) {
break;
}
} catch (AccountStatusException $e) {
$e->setToken($token);
throw $e;
} catch (AuthenticationException $e) {
$lastException = $e;
}
}
if (null !== $result) {
if (true === $this->eraseCredentials) {
$result->eraseCredentials();
}
if (null !== $this->eventDispatcher) {
$this->eventDispatcher->dispatch(AuthenticationEvents::AUTHENTICATION_SUCCESS, new AuthenticationEvent($result));
}
return $result;
}
if (null === $lastException) {
$lastException = new ProviderNotFoundException(sprintf('No Authentication Provider found for token of class "%s".', get_class($token)));
}
if (null !== $this->eventDispatcher) {
$this->eventDispatcher->dispatch(AuthenticationEvents::AUTHENTICATION_FAILURE, new AuthenticationFailureEvent($token, $lastException));
}
$lastException->setToken($token);
throw $lastException;
}
}
}
namespace Symfony\Component\Security\Core\Authentication\Token\Storage
{
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
interface TokenStorageInterface
{
public function getToken();
public function setToken(TokenInterface $token = null);
}
}
namespace Symfony\Component\Security\Core\Authentication\Token\Storage
{
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
class TokenStorage implements TokenStorageInterface
{
private $token;
public function getToken()
{
return $this->token;
}
public function setToken(TokenInterface $token = null)
{
$this->token = $token;
}
}
}
namespace Symfony\Component\Security\Core\Authorization
{
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
interface AccessDecisionManagerInterface
{
public function decide(TokenInterface $token, array $attributes, $object = null);
public function supportsAttribute($attribute);
public function supportsClass($class);
}
}
namespace Symfony\Component\Security\Core\Authorization
{
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
class AccessDecisionManager implements AccessDecisionManagerInterface
{
const STRATEGY_AFFIRMATIVE ='affirmative';
const STRATEGY_CONSENSUS ='consensus';
const STRATEGY_UNANIMOUS ='unanimous';
private $voters;
private $strategy;
private $allowIfAllAbstainDecisions;
private $allowIfEqualGrantedDeniedDecisions;
public function __construct(array $voters = array(), $strategy = self::STRATEGY_AFFIRMATIVE, $allowIfAllAbstainDecisions = false, $allowIfEqualGrantedDeniedDecisions = true)
{
$strategyMethod ='decide'.ucfirst($strategy);
if (!is_callable(array($this, $strategyMethod))) {
throw new \InvalidArgumentException(sprintf('The strategy "%s" is not supported.', $strategy));
}
$this->voters = $voters;
$this->strategy = $strategyMethod;
$this->allowIfAllAbstainDecisions = (bool) $allowIfAllAbstainDecisions;
$this->allowIfEqualGrantedDeniedDecisions = (bool) $allowIfEqualGrantedDeniedDecisions;
}
public function setVoters(array $voters)
{
$this->voters = $voters;
}
public function decide(TokenInterface $token, array $attributes, $object = null)
{
return $this->{$this->strategy}($token, $attributes, $object);
}
public function supportsAttribute($attribute)
{
@trigger_error('The '.__METHOD__.' is deprecated since version 2.8 and will be removed in version 3.0.', E_USER_DEPRECATED);
foreach ($this->voters as $voter) {
if ($voter->supportsAttribute($attribute)) {
return true;
}
}
return false;
}
public function supportsClass($class)
{
@trigger_error('The '.__METHOD__.' is deprecated since version 2.8 and will be removed in version 3.0.', E_USER_DEPRECATED);
foreach ($this->voters as $voter) {
if ($voter->supportsClass($class)) {
return true;
}
}
return false;
}
private function decideAffirmative(TokenInterface $token, array $attributes, $object = null)
{
$deny = 0;
foreach ($this->voters as $voter) {
$result = $voter->vote($token, $object, $attributes);
switch ($result) {
case VoterInterface::ACCESS_GRANTED:
return true;
case VoterInterface::ACCESS_DENIED:
++$deny;
break;
default:
break;
}
}
if ($deny > 0) {
return false;
}
return $this->allowIfAllAbstainDecisions;
}
private function decideConsensus(TokenInterface $token, array $attributes, $object = null)
{
$grant = 0;
$deny = 0;
foreach ($this->voters as $voter) {
$result = $voter->vote($token, $object, $attributes);
switch ($result) {
case VoterInterface::ACCESS_GRANTED:
++$grant;
break;
case VoterInterface::ACCESS_DENIED:
++$deny;
break;
}
}
if ($grant > $deny) {
return true;
}
if ($deny > $grant) {
return false;
}
if ($grant > 0) {
return $this->allowIfEqualGrantedDeniedDecisions;
}
return $this->allowIfAllAbstainDecisions;
}
private function decideUnanimous(TokenInterface $token, array $attributes, $object = null)
{
$grant = 0;
foreach ($attributes as $attribute) {
foreach ($this->voters as $voter) {
$result = $voter->vote($token, $object, array($attribute));
switch ($result) {
case VoterInterface::ACCESS_GRANTED:
++$grant;
break;
case VoterInterface::ACCESS_DENIED:
return false;
default:
break;
}
}
}
if ($grant > 0) {
return true;
}
return $this->allowIfAllAbstainDecisions;
}
}
}
namespace Symfony\Component\Security\Core\Authorization
{
interface AuthorizationCheckerInterface
{
public function isGranted($attributes, $object = null);
}
}
namespace Symfony\Component\Security\Core\Authorization
{
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationCredentialsNotFoundException;
class AuthorizationChecker implements AuthorizationCheckerInterface
{
private $tokenStorage;
private $accessDecisionManager;
private $authenticationManager;
private $alwaysAuthenticate;
public function __construct(TokenStorageInterface $tokenStorage, AuthenticationManagerInterface $authenticationManager, AccessDecisionManagerInterface $accessDecisionManager, $alwaysAuthenticate = false)
{
$this->tokenStorage = $tokenStorage;
$this->authenticationManager = $authenticationManager;
$this->accessDecisionManager = $accessDecisionManager;
$this->alwaysAuthenticate = $alwaysAuthenticate;
}
final public function isGranted($attributes, $object = null)
{
if (null === ($token = $this->tokenStorage->getToken())) {
throw new AuthenticationCredentialsNotFoundException('The token storage contains no authentication token. One possible reason may be that there is no firewall configured for this URL.');
}
if ($this->alwaysAuthenticate || !$token->isAuthenticated()) {
$this->tokenStorage->setToken($token = $this->authenticationManager->authenticate($token));
}
if (!is_array($attributes)) {
$attributes = array($attributes);
}
return $this->accessDecisionManager->decide($token, $attributes, $object);
}
}
}
namespace Symfony\Component\Security\Core\Authorization\Voter
{
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
interface VoterInterface
{
const ACCESS_GRANTED = 1;
const ACCESS_ABSTAIN = 0;
const ACCESS_DENIED = -1;
public function supportsAttribute($attribute);
public function supportsClass($class);
public function vote(TokenInterface $token, $object, array $attributes);
}
}
namespace Symfony\Component\Security\Http
{
use Symfony\Component\HttpFoundation\Request;
interface FirewallMapInterface
{
public function getListeners(Request $request);
}
}
namespace Symfony\Bundle\SecurityBundle\Security
{
use Symfony\Component\Security\Http\FirewallMapInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
class FirewallMap implements FirewallMapInterface
{
protected $container;
protected $map;
public function __construct(ContainerInterface $container, array $map)
{
$this->container = $container;
$this->map = $map;
}
public function getListeners(Request $request)
{
foreach ($this->map as $contextId => $requestMatcher) {
if (null === $requestMatcher || $requestMatcher->matches($request)) {
return $this->container->get($contextId)->getContext();
}
}
return array(array(), null);
}
}
}
namespace Symfony\Bundle\SecurityBundle\Security
{
use Symfony\Component\Security\Http\Firewall\ExceptionListener;
class FirewallContext
{
private $listeners;
private $exceptionListener;
public function __construct(array $listeners, ExceptionListener $exceptionListener = null)
{
$this->listeners = $listeners;
$this->exceptionListener = $exceptionListener;
}
public function getContext()
{
return array($this->listeners, $this->exceptionListener);
}
}
}
namespace Symfony\Component\HttpFoundation
{
interface RequestMatcherInterface
{
public function matches(Request $request);
}
}
namespace Symfony\Component\HttpFoundation
{
class RequestMatcher implements RequestMatcherInterface
{
private $path;
private $host;
private $methods = array();
private $ips = array();
private $attributes = array();
private $schemes = array();
public function __construct($path = null, $host = null, $methods = null, $ips = null, array $attributes = array(), $schemes = null)
{
$this->matchPath($path);
$this->matchHost($host);
$this->matchMethod($methods);
$this->matchIps($ips);
$this->matchScheme($schemes);
foreach ($attributes as $k => $v) {
$this->matchAttribute($k, $v);
}
}
public function matchScheme($scheme)
{
$this->schemes = array_map('strtolower', (array) $scheme);
}
public function matchHost($regexp)
{
$this->host = $regexp;
}
public function matchPath($regexp)
{
$this->path = $regexp;
}
public function matchIp($ip)
{
$this->matchIps($ip);
}
public function matchIps($ips)
{
$this->ips = (array) $ips;
}
public function matchMethod($method)
{
$this->methods = array_map('strtoupper', (array) $method);
}
public function matchAttribute($key, $regexp)
{
$this->attributes[$key] = $regexp;
}
public function matches(Request $request)
{
if ($this->schemes && !in_array($request->getScheme(), $this->schemes)) {
return false;
}
if ($this->methods && !in_array($request->getMethod(), $this->methods)) {
return false;
}
foreach ($this->attributes as $key => $pattern) {
if (!preg_match('{'.$pattern.'}', $request->attributes->get($key))) {
return false;
}
}
if (null !== $this->path && !preg_match('{'.$this->path.'}', rawurldecode($request->getPathInfo()))) {
return false;
}
if (null !== $this->host && !preg_match('{'.$this->host.'}i', $request->getHost())) {
return false;
}
if (IpUtils::checkIp($request->getClientIp(), $this->ips)) {
return true;
}
return count($this->ips) === 0;
}
}
}
namespace
{
class Twig_Environment
{
const VERSION ='1.24.2';
protected $charset;
protected $loader;
protected $debug;
protected $autoReload;
protected $cache;
protected $lexer;
protected $parser;
protected $compiler;
protected $baseTemplateClass;
protected $extensions;
protected $parsers;
protected $visitors;
protected $filters;
protected $tests;
protected $functions;
protected $globals;
protected $runtimeInitialized = false;
protected $extensionInitialized = false;
protected $loadedTemplates;
protected $strictVariables;
protected $unaryOperators;
protected $binaryOperators;
protected $templateClassPrefix ='__TwigTemplate_';
protected $functionCallbacks = array();
protected $filterCallbacks = array();
protected $staging;
private $originalCache;
private $bcWriteCacheFile = false;
private $bcGetCacheFilename = false;
private $lastModifiedExtension = 0;
public function __construct(Twig_LoaderInterface $loader = null, $options = array())
{
if (null !== $loader) {
$this->setLoader($loader);
} else {
@trigger_error('Not passing a Twig_LoaderInterface as the first constructor argument of Twig_Environment is deprecated since version 1.21.', E_USER_DEPRECATED);
}
$options = array_merge(array('debug'=> false,'charset'=>'UTF-8','base_template_class'=>'Twig_Template','strict_variables'=> false,'autoescape'=>'html','cache'=> false,'auto_reload'=> null,'optimizations'=> -1,
), $options);
$this->debug = (bool) $options['debug'];
$this->charset = strtoupper($options['charset']);
$this->baseTemplateClass = $options['base_template_class'];
$this->autoReload = null === $options['auto_reload'] ? $this->debug : (bool) $options['auto_reload'];
$this->strictVariables = (bool) $options['strict_variables'];
$this->setCache($options['cache']);
$this->addExtension(new Twig_Extension_Core());
$this->addExtension(new Twig_Extension_Escaper($options['autoescape']));
$this->addExtension(new Twig_Extension_Optimizer($options['optimizations']));
$this->staging = new Twig_Extension_Staging();
if (is_string($this->originalCache)) {
$r = new ReflectionMethod($this,'writeCacheFile');
if ($r->getDeclaringClass()->getName() !== __CLASS__) {
@trigger_error('The Twig_Environment::writeCacheFile method is deprecated since version 1.22 and will be removed in Twig 2.0.', E_USER_DEPRECATED);
$this->bcWriteCacheFile = true;
}
$r = new ReflectionMethod($this,'getCacheFilename');
if ($r->getDeclaringClass()->getName() !== __CLASS__) {
@trigger_error('The Twig_Environment::getCacheFilename method is deprecated since version 1.22 and will be removed in Twig 2.0.', E_USER_DEPRECATED);
$this->bcGetCacheFilename = true;
}
}
}
public function getBaseTemplateClass()
{
return $this->baseTemplateClass;
}
public function setBaseTemplateClass($class)
{
$this->baseTemplateClass = $class;
}
public function enableDebug()
{
$this->debug = true;
}
public function disableDebug()
{
$this->debug = false;
}
public function isDebug()
{
return $this->debug;
}
public function enableAutoReload()
{
$this->autoReload = true;
}
public function disableAutoReload()
{
$this->autoReload = false;
}
public function isAutoReload()
{
return $this->autoReload;
}
public function enableStrictVariables()
{
$this->strictVariables = true;
}
public function disableStrictVariables()
{
$this->strictVariables = false;
}
public function isStrictVariables()
{
return $this->strictVariables;
}
public function getCache($original = true)
{
return $original ? $this->originalCache : $this->cache;
}
public function setCache($cache)
{
if (is_string($cache)) {
$this->originalCache = $cache;
$this->cache = new Twig_Cache_Filesystem($cache);
} elseif (false === $cache) {
$this->originalCache = $cache;
$this->cache = new Twig_Cache_Null();
} elseif (null === $cache) {
@trigger_error('Using "null" as the cache strategy is deprecated since version 1.23 and will be removed in Twig 2.0.', E_USER_DEPRECATED);
$this->originalCache = false;
$this->cache = new Twig_Cache_Null();
} elseif ($cache instanceof Twig_CacheInterface) {
$this->originalCache = $this->cache = $cache;
} else {
throw new LogicException(sprintf('Cache can only be a string, false, or a Twig_CacheInterface implementation.'));
}
}
public function getCacheFilename($name)
{
@trigger_error(sprintf('The %s method is deprecated since version 1.22 and will be removed in Twig 2.0.', __METHOD__), E_USER_DEPRECATED);
$key = $this->cache->generateKey($name, $this->getTemplateClass($name));
return !$key ? false : $key;
}
public function getTemplateClass($name, $index = null)
{
$key = $this->getLoader()->getCacheKey($name);
$key .= json_encode(array_keys($this->extensions));
$key .= function_exists('twig_template_get_attributes');
return $this->templateClassPrefix.hash('sha256', $key).(null === $index ?'':'_'.$index);
}
public function getTemplateClassPrefix()
{
@trigger_error(sprintf('The %s method is deprecated since version 1.22 and will be removed in Twig 2.0.', __METHOD__), E_USER_DEPRECATED);
return $this->templateClassPrefix;
}
public function render($name, array $context = array())
{
return $this->loadTemplate($name)->render($context);
}
public function display($name, array $context = array())
{
$this->loadTemplate($name)->display($context);
}
public function loadTemplate($name, $index = null)
{
$cls = $this->getTemplateClass($name, $index);
if (isset($this->loadedTemplates[$cls])) {
return $this->loadedTemplates[$cls];
}
if (!class_exists($cls, false)) {
if ($this->bcGetCacheFilename) {
$key = $this->getCacheFilename($name);
} else {
$key = $this->cache->generateKey($name, $cls);
}
if (!$this->isAutoReload() || $this->isTemplateFresh($name, $this->cache->getTimestamp($key))) {
$this->cache->load($key);
}
if (!class_exists($cls, false)) {
$content = $this->compileSource($this->getLoader()->getSource($name), $name);
if ($this->bcWriteCacheFile) {
$this->writeCacheFile($key, $content);
} else {
$this->cache->write($key, $content);
}
eval('?>'.$content);
}
}
if (!$this->runtimeInitialized) {
$this->initRuntime();
}
return $this->loadedTemplates[$cls] = new $cls($this);
}
public function createTemplate($template)
{
$name = sprintf('__string_template__%s', hash('sha256', uniqid(mt_rand(), true), false));
$loader = new Twig_Loader_Chain(array(
new Twig_Loader_Array(array($name => $template)),
$current = $this->getLoader(),
));
$this->setLoader($loader);
try {
$template = $this->loadTemplate($name);
} catch (Exception $e) {
$this->setLoader($current);
throw $e;
} catch (Throwable $e) {
$this->setLoader($current);
throw $e;
}
$this->setLoader($current);
return $template;
}
public function isTemplateFresh($name, $time)
{
if (0 === $this->lastModifiedExtension) {
foreach ($this->extensions as $extension) {
$r = new ReflectionObject($extension);
if (file_exists($r->getFileName()) && ($extensionTime = filemtime($r->getFileName())) > $this->lastModifiedExtension) {
$this->lastModifiedExtension = $extensionTime;
}
}
}
return $this->lastModifiedExtension <= $time && $this->getLoader()->isFresh($name, $time);
}
public function resolveTemplate($names)
{
if (!is_array($names)) {
$names = array($names);
}
foreach ($names as $name) {
if ($name instanceof Twig_Template) {
return $name;
}
try {
return $this->loadTemplate($name);
} catch (Twig_Error_Loader $e) {
}
}
if (1 === count($names)) {
throw $e;
}
throw new Twig_Error_Loader(sprintf('Unable to find one of the following templates: "%s".', implode('", "', $names)));
}
public function clearTemplateCache()
{
@trigger_error(sprintf('The %s method is deprecated since version 1.18.3 and will be removed in Twig 2.0.', __METHOD__), E_USER_DEPRECATED);
$this->loadedTemplates = array();
}
public function clearCacheFiles()
{
@trigger_error(sprintf('The %s method is deprecated since version 1.22 and will be removed in Twig 2.0.', __METHOD__), E_USER_DEPRECATED);
if (is_string($this->originalCache)) {
foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($this->originalCache), RecursiveIteratorIterator::LEAVES_ONLY) as $file) {
if ($file->isFile()) {
@unlink($file->getPathname());
}
}
}
}
public function getLexer()
{
if (null === $this->lexer) {
$this->lexer = new Twig_Lexer($this);
}
return $this->lexer;
}
public function setLexer(Twig_LexerInterface $lexer)
{
$this->lexer = $lexer;
}
public function tokenize($source, $name = null)
{
return $this->getLexer()->tokenize($source, $name);
}
public function getParser()
{
if (null === $this->parser) {
$this->parser = new Twig_Parser($this);
}
return $this->parser;
}
public function setParser(Twig_ParserInterface $parser)
{
$this->parser = $parser;
}
public function parse(Twig_TokenStream $stream)
{
return $this->getParser()->parse($stream);
}
public function getCompiler()
{
if (null === $this->compiler) {
$this->compiler = new Twig_Compiler($this);
}
return $this->compiler;
}
public function setCompiler(Twig_CompilerInterface $compiler)
{
$this->compiler = $compiler;
}
public function compile(Twig_NodeInterface $node)
{
return $this->getCompiler()->compile($node)->getSource();
}
public function compileSource($source, $name = null)
{
try {
$compiled = $this->compile($this->parse($this->tokenize($source, $name)), $source);
if (isset($source[0])) {
$compiled .='/* '.str_replace(array('*/',"\r\n","\r","\n"), array('*//* ',"\n","\n","*/\n/* "), $source)."*/\n";
}
return $compiled;
} catch (Twig_Error $e) {
$e->setTemplateFile($name);
throw $e;
} catch (Exception $e) {
throw new Twig_Error_Syntax(sprintf('An exception has been thrown during the compilation of a template ("%s").', $e->getMessage()), -1, $name, $e);
}
}
public function setLoader(Twig_LoaderInterface $loader)
{
$this->loader = $loader;
}
public function getLoader()
{
if (null === $this->loader) {
throw new LogicException('You must set a loader first.');
}
return $this->loader;
}
public function setCharset($charset)
{
$this->charset = strtoupper($charset);
}
public function getCharset()
{
return $this->charset;
}
public function initRuntime()
{
$this->runtimeInitialized = true;
foreach ($this->getExtensions() as $name => $extension) {
if (!$extension instanceof Twig_Extension_InitRuntimeInterface) {
$m = new ReflectionMethod($extension,'initRuntime');
if ('Twig_Extension'!== $m->getDeclaringClass()->getName()) {
@trigger_error(sprintf('Defining the initRuntime() method in the "%s" extension is deprecated since version 1.23. Use the `needs_environment` option to get the Twig_Environment instance in filters, functions, or tests; or explicitly implement Twig_Extension_InitRuntimeInterface if needed (not recommended).', $name), E_USER_DEPRECATED);
}
}
$extension->initRuntime($this);
}
}
public function hasExtension($name)
{
return isset($this->extensions[$name]);
}
public function getExtension($name)
{
if (!isset($this->extensions[$name])) {
throw new Twig_Error_Runtime(sprintf('The "%s" extension is not enabled.', $name));
}
return $this->extensions[$name];
}
public function addExtension(Twig_ExtensionInterface $extension)
{
$name = $extension->getName();
if ($this->extensionInitialized) {
throw new LogicException(sprintf('Unable to register extension "%s" as extensions have already been initialized.', $name));
}
if (isset($this->extensions[$name])) {
@trigger_error(sprintf('The possibility to register the same extension twice ("%s") is deprecated since version 1.23 and will be removed in Twig 2.0. Use proper PHP inheritance instead.', $name), E_USER_DEPRECATED);
}
$this->lastModifiedExtension = 0;
$this->extensions[$name] = $extension;
}
public function removeExtension($name)
{
@trigger_error(sprintf('The %s method is deprecated since version 1.12 and will be removed in Twig 2.0.', __METHOD__), E_USER_DEPRECATED);
if ($this->extensionInitialized) {
throw new LogicException(sprintf('Unable to remove extension "%s" as extensions have already been initialized.', $name));
}
unset($this->extensions[$name]);
}
public function setExtensions(array $extensions)
{
foreach ($extensions as $extension) {
$this->addExtension($extension);
}
}
public function getExtensions()
{
return $this->extensions;
}
public function addTokenParser(Twig_TokenParserInterface $parser)
{
if ($this->extensionInitialized) {
throw new LogicException('Unable to add a token parser as extensions have already been initialized.');
}
$this->staging->addTokenParser($parser);
}
public function getTokenParsers()
{
if (!$this->extensionInitialized) {
$this->initExtensions();
}
return $this->parsers;
}
public function getTags()
{
$tags = array();
foreach ($this->getTokenParsers()->getParsers() as $parser) {
if ($parser instanceof Twig_TokenParserInterface) {
$tags[$parser->getTag()] = $parser;
}
}
return $tags;
}
public function addNodeVisitor(Twig_NodeVisitorInterface $visitor)
{
if ($this->extensionInitialized) {
throw new LogicException('Unable to add a node visitor as extensions have already been initialized.');
}
$this->staging->addNodeVisitor($visitor);
}
public function getNodeVisitors()
{
if (!$this->extensionInitialized) {
$this->initExtensions();
}
return $this->visitors;
}
public function addFilter($name, $filter = null)
{
if (!$name instanceof Twig_SimpleFilter && !($filter instanceof Twig_SimpleFilter || $filter instanceof Twig_FilterInterface)) {
throw new LogicException('A filter must be an instance of Twig_FilterInterface or Twig_SimpleFilter');
}
if ($name instanceof Twig_SimpleFilter) {
$filter = $name;
$name = $filter->getName();
} else {
@trigger_error(sprintf('Passing a name as a first argument to the %s method is deprecated since version 1.21. Pass an instance of "Twig_SimpleFilter" instead when defining filter "%s".', __METHOD__, $name), E_USER_DEPRECATED);
}
if ($this->extensionInitialized) {
throw new LogicException(sprintf('Unable to add filter "%s" as extensions have already been initialized.', $name));
}
$this->staging->addFilter($name, $filter);
}
public function getFilter($name)
{
if (!$this->extensionInitialized) {
$this->initExtensions();
}
if (isset($this->filters[$name])) {
return $this->filters[$name];
}
foreach ($this->filters as $pattern => $filter) {
$pattern = str_replace('\\*','(.*?)', preg_quote($pattern,'#'), $count);
if ($count) {
if (preg_match('#^'.$pattern.'$#', $name, $matches)) {
array_shift($matches);
$filter->setArguments($matches);
return $filter;
}
}
}
foreach ($this->filterCallbacks as $callback) {
if (false !== $filter = call_user_func($callback, $name)) {
return $filter;
}
}
return false;
}
public function registerUndefinedFilterCallback($callable)
{
$this->filterCallbacks[] = $callable;
}
public function getFilters()
{
if (!$this->extensionInitialized) {
$this->initExtensions();
}
return $this->filters;
}
public function addTest($name, $test = null)
{
if (!$name instanceof Twig_SimpleTest && !($test instanceof Twig_SimpleTest || $test instanceof Twig_TestInterface)) {
throw new LogicException('A test must be an instance of Twig_TestInterface or Twig_SimpleTest');
}
if ($name instanceof Twig_SimpleTest) {
$test = $name;
$name = $test->getName();
} else {
@trigger_error(sprintf('Passing a name as a first argument to the %s method is deprecated since version 1.21. Pass an instance of "Twig_SimpleTest" instead when defining test "%s".', __METHOD__, $name), E_USER_DEPRECATED);
}
if ($this->extensionInitialized) {
throw new LogicException(sprintf('Unable to add test "%s" as extensions have already been initialized.', $name));
}
$this->staging->addTest($name, $test);
}
public function getTests()
{
if (!$this->extensionInitialized) {
$this->initExtensions();
}
return $this->tests;
}
public function getTest($name)
{
if (!$this->extensionInitialized) {
$this->initExtensions();
}
if (isset($this->tests[$name])) {
return $this->tests[$name];
}
return false;
}
public function addFunction($name, $function = null)
{
if (!$name instanceof Twig_SimpleFunction && !($function instanceof Twig_SimpleFunction || $function instanceof Twig_FunctionInterface)) {
throw new LogicException('A function must be an instance of Twig_FunctionInterface or Twig_SimpleFunction');
}
if ($name instanceof Twig_SimpleFunction) {
$function = $name;
$name = $function->getName();
} else {
@trigger_error(sprintf('Passing a name as a first argument to the %s method is deprecated since version 1.21. Pass an instance of "Twig_SimpleFunction" instead when defining function "%s".', __METHOD__, $name), E_USER_DEPRECATED);
}
if ($this->extensionInitialized) {
throw new LogicException(sprintf('Unable to add function "%s" as extensions have already been initialized.', $name));
}
$this->staging->addFunction($name, $function);
}
public function getFunction($name)
{
if (!$this->extensionInitialized) {
$this->initExtensions();
}
if (isset($this->functions[$name])) {
return $this->functions[$name];
}
foreach ($this->functions as $pattern => $function) {
$pattern = str_replace('\\*','(.*?)', preg_quote($pattern,'#'), $count);
if ($count) {
if (preg_match('#^'.$pattern.'$#', $name, $matches)) {
array_shift($matches);
$function->setArguments($matches);
return $function;
}
}
}
foreach ($this->functionCallbacks as $callback) {
if (false !== $function = call_user_func($callback, $name)) {
return $function;
}
}
return false;
}
public function registerUndefinedFunctionCallback($callable)
{
$this->functionCallbacks[] = $callable;
}
public function getFunctions()
{
if (!$this->extensionInitialized) {
$this->initExtensions();
}
return $this->functions;
}
public function addGlobal($name, $value)
{
if ($this->extensionInitialized || $this->runtimeInitialized) {
if (null === $this->globals) {
$this->globals = $this->initGlobals();
}
if (!array_key_exists($name, $this->globals)) {
@trigger_error(sprintf('Registering global variable "%s" at runtime or when the extensions have already been initialized is deprecated since version 1.21.', $name), E_USER_DEPRECATED);
}
}
if ($this->extensionInitialized || $this->runtimeInitialized) {
$this->globals[$name] = $value;
} else {
$this->staging->addGlobal($name, $value);
}
}
public function getGlobals()
{
if (!$this->runtimeInitialized && !$this->extensionInitialized) {
return $this->initGlobals();
}
if (null === $this->globals) {
$this->globals = $this->initGlobals();
}
return $this->globals;
}
public function mergeGlobals(array $context)
{
foreach ($this->getGlobals() as $key => $value) {
if (!array_key_exists($key, $context)) {
$context[$key] = $value;
}
}
return $context;
}
public function getUnaryOperators()
{
if (!$this->extensionInitialized) {
$this->initExtensions();
}
return $this->unaryOperators;
}
public function getBinaryOperators()
{
if (!$this->extensionInitialized) {
$this->initExtensions();
}
return $this->binaryOperators;
}
public function computeAlternatives($name, $items)
{
@trigger_error(sprintf('The %s method is deprecated since version 1.23 and will be removed in Twig 2.0.', __METHOD__), E_USER_DEPRECATED);
return Twig_Error_Syntax::computeAlternatives($name, $items);
}
protected function initGlobals()
{
$globals = array();
foreach ($this->extensions as $name => $extension) {
if (!$extension instanceof Twig_Extension_GlobalsInterface) {
$m = new ReflectionMethod($extension,'getGlobals');
if ('Twig_Extension'!== $m->getDeclaringClass()->getName()) {
@trigger_error(sprintf('Defining the getGlobals() method in the "%s" extension without explicitly implementing Twig_Extension_GlobalsInterface is deprecated since version 1.23.', $name), E_USER_DEPRECATED);
}
}
$extGlob = $extension->getGlobals();
if (!is_array($extGlob)) {
throw new UnexpectedValueException(sprintf('"%s::getGlobals()" must return an array of globals.', get_class($extension)));
}
$globals[] = $extGlob;
}
$globals[] = $this->staging->getGlobals();
return call_user_func_array('array_merge', $globals);
}
protected function initExtensions()
{
if ($this->extensionInitialized) {
return;
}
$this->extensionInitialized = true;
$this->parsers = new Twig_TokenParserBroker(array(), array(), false);
$this->filters = array();
$this->functions = array();
$this->tests = array();
$this->visitors = array();
$this->unaryOperators = array();
$this->binaryOperators = array();
foreach ($this->extensions as $extension) {
$this->initExtension($extension);
}
$this->initExtension($this->staging);
}
protected function initExtension(Twig_ExtensionInterface $extension)
{
foreach ($extension->getFilters() as $name => $filter) {
if ($filter instanceof Twig_SimpleFilter) {
$name = $filter->getName();
} else {
@trigger_error(sprintf('Using an instance of "%s" for filter "%s" is deprecated since version 1.21. Use Twig_SimpleFilter instead.', get_class($filter), $name), E_USER_DEPRECATED);
}
$this->filters[$name] = $filter;
}
foreach ($extension->getFunctions() as $name => $function) {
if ($function instanceof Twig_SimpleFunction) {
$name = $function->getName();
} else {
@trigger_error(sprintf('Using an instance of "%s" for function "%s" is deprecated since version 1.21. Use Twig_SimpleFunction instead.', get_class($function), $name), E_USER_DEPRECATED);
}
$this->functions[$name] = $function;
}
foreach ($extension->getTests() as $name => $test) {
if ($test instanceof Twig_SimpleTest) {
$name = $test->getName();
} else {
@trigger_error(sprintf('Using an instance of "%s" for test "%s" is deprecated since version 1.21. Use Twig_SimpleTest instead.', get_class($test), $name), E_USER_DEPRECATED);
}
$this->tests[$name] = $test;
}
foreach ($extension->getTokenParsers() as $parser) {
if ($parser instanceof Twig_TokenParserInterface) {
$this->parsers->addTokenParser($parser);
} elseif ($parser instanceof Twig_TokenParserBrokerInterface) {
@trigger_error('Registering a Twig_TokenParserBrokerInterface instance is deprecated since version 1.21.', E_USER_DEPRECATED);
$this->parsers->addTokenParserBroker($parser);
} else {
throw new LogicException('getTokenParsers() must return an array of Twig_TokenParserInterface or Twig_TokenParserBrokerInterface instances');
}
}
foreach ($extension->getNodeVisitors() as $visitor) {
$this->visitors[] = $visitor;
}
if ($operators = $extension->getOperators()) {
if (2 !== count($operators)) {
throw new InvalidArgumentException(sprintf('"%s::getOperators()" does not return a valid operators array.', get_class($extension)));
}
$this->unaryOperators = array_merge($this->unaryOperators, $operators[0]);
$this->binaryOperators = array_merge($this->binaryOperators, $operators[1]);
}
}
protected function writeCacheFile($file, $content)
{
$this->cache->write($file, $content);
}
}
}
namespace
{
interface Twig_ExtensionInterface
{
public function initRuntime(Twig_Environment $environment);
public function getTokenParsers();
public function getNodeVisitors();
public function getFilters();
public function getTests();
public function getFunctions();
public function getOperators();
public function getGlobals();
public function getName();
}
}
namespace
{
abstract class Twig_Extension implements Twig_ExtensionInterface
{
public function initRuntime(Twig_Environment $environment)
{
}
public function getTokenParsers()
{
return array();
}
public function getNodeVisitors()
{
return array();
}
public function getFilters()
{
return array();
}
public function getTests()
{
return array();
}
public function getFunctions()
{
return array();
}
public function getOperators()
{
return array();
}
public function getGlobals()
{
return array();
}
}
}
namespace
{
if (!defined('ENT_SUBSTITUTE')) {
define('ENT_SUBSTITUTE', 0);
}
class Twig_Extension_Core extends Twig_Extension
{
protected $dateFormats = array('F j, Y H:i','%d days');
protected $numberFormat = array(0,'.',',');
protected $timezone = null;
protected $escapers = array();
public function setEscaper($strategy, $callable)
{
$this->escapers[$strategy] = $callable;
}
public function getEscapers()
{
return $this->escapers;
}
public function setDateFormat($format = null, $dateIntervalFormat = null)
{
if (null !== $format) {
$this->dateFormats[0] = $format;
}
if (null !== $dateIntervalFormat) {
$this->dateFormats[1] = $dateIntervalFormat;
}
}
public function getDateFormat()
{
return $this->dateFormats;
}
public function setTimezone($timezone)
{
$this->timezone = $timezone instanceof DateTimeZone ? $timezone : new DateTimeZone($timezone);
}
public function getTimezone()
{
if (null === $this->timezone) {
$this->timezone = new DateTimeZone(date_default_timezone_get());
}
return $this->timezone;
}
public function setNumberFormat($decimal, $decimalPoint, $thousandSep)
{
$this->numberFormat = array($decimal, $decimalPoint, $thousandSep);
}
public function getNumberFormat()
{
return $this->numberFormat;
}
public function getTokenParsers()
{
return array(
new Twig_TokenParser_For(),
new Twig_TokenParser_If(),
new Twig_TokenParser_Extends(),
new Twig_TokenParser_Include(),
new Twig_TokenParser_Block(),
new Twig_TokenParser_Use(),
new Twig_TokenParser_Filter(),
new Twig_TokenParser_Macro(),
new Twig_TokenParser_Import(),
new Twig_TokenParser_From(),
new Twig_TokenParser_Set(),
new Twig_TokenParser_Spaceless(),
new Twig_TokenParser_Flush(),
new Twig_TokenParser_Do(),
new Twig_TokenParser_Embed(),
);
}
public function getFilters()
{
$filters = array(
new Twig_SimpleFilter('date','twig_date_format_filter', array('needs_environment'=> true)),
new Twig_SimpleFilter('date_modify','twig_date_modify_filter', array('needs_environment'=> true)),
new Twig_SimpleFilter('format','sprintf'),
new Twig_SimpleFilter('replace','twig_replace_filter'),
new Twig_SimpleFilter('number_format','twig_number_format_filter', array('needs_environment'=> true)),
new Twig_SimpleFilter('abs','abs'),
new Twig_SimpleFilter('round','twig_round'),
new Twig_SimpleFilter('url_encode','twig_urlencode_filter'),
new Twig_SimpleFilter('json_encode','twig_jsonencode_filter'),
new Twig_SimpleFilter('convert_encoding','twig_convert_encoding'),
new Twig_SimpleFilter('title','twig_title_string_filter', array('needs_environment'=> true)),
new Twig_SimpleFilter('capitalize','twig_capitalize_string_filter', array('needs_environment'=> true)),
new Twig_SimpleFilter('upper','strtoupper'),
new Twig_SimpleFilter('lower','strtolower'),
new Twig_SimpleFilter('striptags','strip_tags'),
new Twig_SimpleFilter('trim','trim'),
new Twig_SimpleFilter('nl2br','nl2br', array('pre_escape'=>'html','is_safe'=> array('html'))),
new Twig_SimpleFilter('join','twig_join_filter'),
new Twig_SimpleFilter('split','twig_split_filter', array('needs_environment'=> true)),
new Twig_SimpleFilter('sort','twig_sort_filter'),
new Twig_SimpleFilter('merge','twig_array_merge'),
new Twig_SimpleFilter('batch','twig_array_batch'),
new Twig_SimpleFilter('reverse','twig_reverse_filter', array('needs_environment'=> true)),
new Twig_SimpleFilter('length','twig_length_filter', array('needs_environment'=> true)),
new Twig_SimpleFilter('slice','twig_slice', array('needs_environment'=> true)),
new Twig_SimpleFilter('first','twig_first', array('needs_environment'=> true)),
new Twig_SimpleFilter('last','twig_last', array('needs_environment'=> true)),
new Twig_SimpleFilter('default','_twig_default_filter', array('node_class'=>'Twig_Node_Expression_Filter_Default')),
new Twig_SimpleFilter('keys','twig_get_array_keys_filter'),
new Twig_SimpleFilter('escape','twig_escape_filter', array('needs_environment'=> true,'is_safe_callback'=>'twig_escape_filter_is_safe')),
new Twig_SimpleFilter('e','twig_escape_filter', array('needs_environment'=> true,'is_safe_callback'=>'twig_escape_filter_is_safe')),
);
if (function_exists('mb_get_info')) {
$filters[] = new Twig_SimpleFilter('upper','twig_upper_filter', array('needs_environment'=> true));
$filters[] = new Twig_SimpleFilter('lower','twig_lower_filter', array('needs_environment'=> true));
}
return $filters;
}
public function getFunctions()
{
return array(
new Twig_SimpleFunction('max','max'),
new Twig_SimpleFunction('min','min'),
new Twig_SimpleFunction('range','range'),
new Twig_SimpleFunction('constant','twig_constant'),
new Twig_SimpleFunction('cycle','twig_cycle'),
new Twig_SimpleFunction('random','twig_random', array('needs_environment'=> true)),
new Twig_SimpleFunction('date','twig_date_converter', array('needs_environment'=> true)),
new Twig_SimpleFunction('include','twig_include', array('needs_environment'=> true,'needs_context'=> true,'is_safe'=> array('all'))),
new Twig_SimpleFunction('source','twig_source', array('needs_environment'=> true,'is_safe'=> array('all'))),
);
}
public function getTests()
{
return array(
new Twig_SimpleTest('even', null, array('node_class'=>'Twig_Node_Expression_Test_Even')),
new Twig_SimpleTest('odd', null, array('node_class'=>'Twig_Node_Expression_Test_Odd')),
new Twig_SimpleTest('defined', null, array('node_class'=>'Twig_Node_Expression_Test_Defined')),
new Twig_SimpleTest('sameas', null, array('node_class'=>'Twig_Node_Expression_Test_Sameas','deprecated'=>'1.21','alternative'=>'same as')),
new Twig_SimpleTest('same as', null, array('node_class'=>'Twig_Node_Expression_Test_Sameas')),
new Twig_SimpleTest('none', null, array('node_class'=>'Twig_Node_Expression_Test_Null')),
new Twig_SimpleTest('null', null, array('node_class'=>'Twig_Node_Expression_Test_Null')),
new Twig_SimpleTest('divisibleby', null, array('node_class'=>'Twig_Node_Expression_Test_Divisibleby','deprecated'=>'1.21','alternative'=>'divisible by')),
new Twig_SimpleTest('divisible by', null, array('node_class'=>'Twig_Node_Expression_Test_Divisibleby')),
new Twig_SimpleTest('constant', null, array('node_class'=>'Twig_Node_Expression_Test_Constant')),
new Twig_SimpleTest('empty','twig_test_empty'),
new Twig_SimpleTest('iterable','twig_test_iterable'),
);
}
public function getOperators()
{
return array(
array('not'=> array('precedence'=> 50,'class'=>'Twig_Node_Expression_Unary_Not'),'-'=> array('precedence'=> 500,'class'=>'Twig_Node_Expression_Unary_Neg'),'+'=> array('precedence'=> 500,'class'=>'Twig_Node_Expression_Unary_Pos'),
),
array('or'=> array('precedence'=> 10,'class'=>'Twig_Node_Expression_Binary_Or','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'and'=> array('precedence'=> 15,'class'=>'Twig_Node_Expression_Binary_And','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'b-or'=> array('precedence'=> 16,'class'=>'Twig_Node_Expression_Binary_BitwiseOr','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'b-xor'=> array('precedence'=> 17,'class'=>'Twig_Node_Expression_Binary_BitwiseXor','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'b-and'=> array('precedence'=> 18,'class'=>'Twig_Node_Expression_Binary_BitwiseAnd','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'=='=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_Equal','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'!='=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_NotEqual','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'<'=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_Less','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'>'=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_Greater','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'>='=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_GreaterEqual','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'<='=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_LessEqual','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'not in'=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_NotIn','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'in'=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_In','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'matches'=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_Matches','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'starts with'=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_StartsWith','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'ends with'=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_EndsWith','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'..'=> array('precedence'=> 25,'class'=>'Twig_Node_Expression_Binary_Range','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'+'=> array('precedence'=> 30,'class'=>'Twig_Node_Expression_Binary_Add','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'-'=> array('precedence'=> 30,'class'=>'Twig_Node_Expression_Binary_Sub','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'~'=> array('precedence'=> 40,'class'=>'Twig_Node_Expression_Binary_Concat','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'*'=> array('precedence'=> 60,'class'=>'Twig_Node_Expression_Binary_Mul','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'/'=> array('precedence'=> 60,'class'=>'Twig_Node_Expression_Binary_Div','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'//'=> array('precedence'=> 60,'class'=>'Twig_Node_Expression_Binary_FloorDiv','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'%'=> array('precedence'=> 60,'class'=>'Twig_Node_Expression_Binary_Mod','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'is'=> array('precedence'=> 100,'callable'=> array($this,'parseTestExpression'),'associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'is not'=> array('precedence'=> 100,'callable'=> array($this,'parseNotTestExpression'),'associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'**'=> array('precedence'=> 200,'class'=>'Twig_Node_Expression_Binary_Power','associativity'=> Twig_ExpressionParser::OPERATOR_RIGHT),'??'=> array('precedence'=> 300,'class'=>'Twig_Node_Expression_NullCoalesce','associativity'=> Twig_ExpressionParser::OPERATOR_RIGHT),
),
);
}
public function parseNotTestExpression(Twig_Parser $parser, Twig_NodeInterface $node)
{
return new Twig_Node_Expression_Unary_Not($this->parseTestExpression($parser, $node), $parser->getCurrentToken()->getLine());
}
public function parseTestExpression(Twig_Parser $parser, Twig_NodeInterface $node)
{
$stream = $parser->getStream();
list($name, $test) = $this->getTest($parser, $node->getLine());
if ($test instanceof Twig_SimpleTest && $test->isDeprecated()) {
$message = sprintf('Twig Test "%s" is deprecated', $name);
if (!is_bool($test->getDeprecatedVersion())) {
$message .= sprintf(' since version %s', $test->getDeprecatedVersion());
}
if ($test->getAlternative()) {
$message .= sprintf('. Use "%s" instead', $test->getAlternative());
}
$message .= sprintf(' in %s at line %d.', $stream->getFilename(), $stream->getCurrent()->getLine());
@trigger_error($message, E_USER_DEPRECATED);
}
$class = $this->getTestNodeClass($parser, $test);
$arguments = null;
if ($stream->test(Twig_Token::PUNCTUATION_TYPE,'(')) {
$arguments = $parser->getExpressionParser()->parseArguments(true);
}
return new $class($node, $name, $arguments, $parser->getCurrentToken()->getLine());
}
protected function getTest(Twig_Parser $parser, $line)
{
$stream = $parser->getStream();
$name = $stream->expect(Twig_Token::NAME_TYPE)->getValue();
$env = $parser->getEnvironment();
if ($test = $env->getTest($name)) {
return array($name, $test);
}
if ($stream->test(Twig_Token::NAME_TYPE)) {
$name = $name.' '.$parser->getCurrentToken()->getValue();
if ($test = $env->getTest($name)) {
$parser->getStream()->next();
return array($name, $test);
}
}
$e = new Twig_Error_Syntax(sprintf('Unknown "%s" test.', $name), $line, $parser->getFilename());
$e->addSuggestions($name, array_keys($env->getTests()));
throw $e;
}
protected function getTestNodeClass(Twig_Parser $parser, $test)
{
if ($test instanceof Twig_SimpleTest) {
return $test->getNodeClass();
}
return $test instanceof Twig_Test_Node ? $test->getClass() :'Twig_Node_Expression_Test';
}
public function getName()
{
return'core';
}
}
function twig_cycle($values, $position)
{
if (!is_array($values) && !$values instanceof ArrayAccess) {
return $values;
}
return $values[$position % count($values)];
}
function twig_random(Twig_Environment $env, $values = null)
{
if (null === $values) {
return mt_rand();
}
if (is_int($values) || is_float($values)) {
return $values < 0 ? mt_rand($values, 0) : mt_rand(0, $values);
}
if ($values instanceof Traversable) {
$values = iterator_to_array($values);
} elseif (is_string($values)) {
if (''=== $values) {
return'';
}
if (null !== $charset = $env->getCharset()) {
if ('UTF-8'!== $charset) {
$values = twig_convert_encoding($values,'UTF-8', $charset);
}
$values = preg_split('/(?<!^)(?!$)/u', $values);
if ('UTF-8'!== $charset) {
foreach ($values as $i => $value) {
$values[$i] = twig_convert_encoding($value, $charset,'UTF-8');
}
}
} else {
return $values[mt_rand(0, strlen($values) - 1)];
}
}
if (!is_array($values)) {
return $values;
}
if (0 === count($values)) {
throw new Twig_Error_Runtime('The random function cannot pick from an empty array.');
}
return $values[array_rand($values, 1)];
}
function twig_date_format_filter(Twig_Environment $env, $date, $format = null, $timezone = null)
{
if (null === $format) {
$formats = $env->getExtension('core')->getDateFormat();
$format = $date instanceof DateInterval ? $formats[1] : $formats[0];
}
if ($date instanceof DateInterval) {
return $date->format($format);
}
return twig_date_converter($env, $date, $timezone)->format($format);
}
function twig_date_modify_filter(Twig_Environment $env, $date, $modifier)
{
$date = twig_date_converter($env, $date, false);
$resultDate = $date->modify($modifier);
return null === $resultDate ? $date : $resultDate;
}
function twig_date_converter(Twig_Environment $env, $date = null, $timezone = null)
{
if (false !== $timezone) {
if (null === $timezone) {
$timezone = $env->getExtension('core')->getTimezone();
} elseif (!$timezone instanceof DateTimeZone) {
$timezone = new DateTimeZone($timezone);
}
}
if ($date instanceof DateTimeImmutable) {
return false !== $timezone ? $date->setTimezone($timezone) : $date;
}
if ($date instanceof DateTime || $date instanceof DateTimeInterface) {
$date = clone $date;
if (false !== $timezone) {
$date->setTimezone($timezone);
}
return $date;
}
if (null === $date ||'now'=== $date) {
return new DateTime($date, false !== $timezone ? $timezone : $env->getExtension('core')->getTimezone());
}
$asString = (string) $date;
if (ctype_digit($asString) || (!empty($asString) &&'-'=== $asString[0] && ctype_digit(substr($asString, 1)))) {
$date = new DateTime('@'.$date);
} else {
$date = new DateTime($date, $env->getExtension('core')->getTimezone());
}
if (false !== $timezone) {
$date->setTimezone($timezone);
}
return $date;
}
function twig_replace_filter($str, $from, $to = null)
{
if ($from instanceof Traversable) {
$from = iterator_to_array($from);
} elseif (is_string($from) && is_string($to)) {
@trigger_error('Using "replace" with character by character replacement is deprecated since version 1.22 and will be removed in Twig 2.0', E_USER_DEPRECATED);
return strtr($str, $from, $to);
} elseif (!is_array($from)) {
throw new Twig_Error_Runtime(sprintf('The "replace" filter expects an array or "Traversable" as replace values, got "%s".',is_object($from) ? get_class($from) : gettype($from)));
}
return strtr($str, $from);
}
function twig_round($value, $precision = 0, $method ='common')
{
if ('common'== $method) {
return round($value, $precision);
}
if ('ceil'!= $method &&'floor'!= $method) {
throw new Twig_Error_Runtime('The round filter only supports the "common", "ceil", and "floor" methods.');
}
return $method($value * pow(10, $precision)) / pow(10, $precision);
}
function twig_number_format_filter(Twig_Environment $env, $number, $decimal = null, $decimalPoint = null, $thousandSep = null)
{
$defaults = $env->getExtension('core')->getNumberFormat();
if (null === $decimal) {
$decimal = $defaults[0];
}
if (null === $decimalPoint) {
$decimalPoint = $defaults[1];
}
if (null === $thousandSep) {
$thousandSep = $defaults[2];
}
return number_format((float) $number, $decimal, $decimalPoint, $thousandSep);
}
function twig_urlencode_filter($url)
{
if (is_array($url)) {
if (defined('PHP_QUERY_RFC3986')) {
return http_build_query($url,'','&', PHP_QUERY_RFC3986);
}
return http_build_query($url,'','&');
}
return rawurlencode($url);
}
if (PHP_VERSION_ID < 50300) {
function twig_jsonencode_filter($value, $options = 0)
{
if ($value instanceof Twig_Markup) {
$value = (string) $value;
} elseif (is_array($value)) {
array_walk_recursive($value,'_twig_markup2string');
}
return json_encode($value);
}
} else {
function twig_jsonencode_filter($value, $options = 0)
{
if ($value instanceof Twig_Markup) {
$value = (string) $value;
} elseif (is_array($value)) {
array_walk_recursive($value,'_twig_markup2string');
}
return json_encode($value, $options);
}
}
function _twig_markup2string(&$value)
{
if ($value instanceof Twig_Markup) {
$value = (string) $value;
}
}
function twig_array_merge($arr1, $arr2)
{
if ($arr1 instanceof Traversable) {
$arr1 = iterator_to_array($arr1);
} elseif (!is_array($arr1)) {
throw new Twig_Error_Runtime(sprintf('The merge filter only works with arrays or "Traversable", got "%s" as first argument.', gettype($arr1)));
}
if ($arr2 instanceof Traversable) {
$arr2 = iterator_to_array($arr2);
} elseif (!is_array($arr2)) {
throw new Twig_Error_Runtime(sprintf('The merge filter only works with arrays or "Traversable", got "%s" as second argument.', gettype($arr2)));
}
return array_merge($arr1, $arr2);
}
function twig_slice(Twig_Environment $env, $item, $start, $length = null, $preserveKeys = false)
{
if ($item instanceof Traversable) {
if ($item instanceof IteratorAggregate) {
$item = $item->getIterator();
}
if ($start >= 0 && $length >= 0 && $item instanceof Iterator) {
try {
return iterator_to_array(new LimitIterator($item, $start, $length === null ? -1 : $length), $preserveKeys);
} catch (OutOfBoundsException $exception) {
return array();
}
}
$item = iterator_to_array($item, $preserveKeys);
}
if (is_array($item)) {
return array_slice($item, $start, $length, $preserveKeys);
}
$item = (string) $item;
if (function_exists('mb_get_info') && null !== $charset = $env->getCharset()) {
return (string) mb_substr($item, $start, null === $length ? mb_strlen($item, $charset) - $start : $length, $charset);
}
return (string) (null === $length ? substr($item, $start) : substr($item, $start, $length));
}
function twig_first(Twig_Environment $env, $item)
{
$elements = twig_slice($env, $item, 0, 1, false);
return is_string($elements) ? $elements : current($elements);
}
function twig_last(Twig_Environment $env, $item)
{
$elements = twig_slice($env, $item, -1, 1, false);
return is_string($elements) ? $elements : current($elements);
}
function twig_join_filter($value, $glue ='')
{
if ($value instanceof Traversable) {
$value = iterator_to_array($value, false);
}
return implode($glue, (array) $value);
}
function twig_split_filter(Twig_Environment $env, $value, $delimiter, $limit = null)
{
if (!empty($delimiter)) {
return null === $limit ? explode($delimiter, $value) : explode($delimiter, $value, $limit);
}
if (!function_exists('mb_get_info') || null === $charset = $env->getCharset()) {
return str_split($value, null === $limit ? 1 : $limit);
}
if ($limit <= 1) {
return preg_split('/(?<!^)(?!$)/u', $value);
}
$length = mb_strlen($value, $charset);
if ($length < $limit) {
return array($value);
}
$r = array();
for ($i = 0; $i < $length; $i += $limit) {
$r[] = mb_substr($value, $i, $limit, $charset);
}
return $r;
}
function _twig_default_filter($value, $default ='')
{
if (twig_test_empty($value)) {
return $default;
}
return $value;
}
function twig_get_array_keys_filter($array)
{
if ($array instanceof Traversable) {
return array_keys(iterator_to_array($array));
}
if (!is_array($array)) {
return array();
}
return array_keys($array);
}
function twig_reverse_filter(Twig_Environment $env, $item, $preserveKeys = false)
{
if ($item instanceof Traversable) {
return array_reverse(iterator_to_array($item), $preserveKeys);
}
if (is_array($item)) {
return array_reverse($item, $preserveKeys);
}
if (null !== $charset = $env->getCharset()) {
$string = (string) $item;
if ('UTF-8'!== $charset) {
$item = twig_convert_encoding($string,'UTF-8', $charset);
}
preg_match_all('/./us', $item, $matches);
$string = implode('', array_reverse($matches[0]));
if ('UTF-8'!== $charset) {
$string = twig_convert_encoding($string, $charset,'UTF-8');
}
return $string;
}
return strrev((string) $item);
}
function twig_sort_filter($array)
{
if ($array instanceof Traversable) {
$array = iterator_to_array($array);
} elseif (!is_array($array)) {
throw new Twig_Error_Runtime(sprintf('The sort filter only works with arrays or "Traversable", got "%s".', gettype($array)));
}
asort($array);
return $array;
}
function twig_in_filter($value, $compare)
{
if (is_array($compare)) {
return in_array($value, $compare, is_object($value) || is_resource($value));
} elseif (is_string($compare) && (is_string($value) || is_int($value) || is_float($value))) {
return''=== $value || false !== strpos($compare, (string) $value);
} elseif ($compare instanceof Traversable) {
return in_array($value, iterator_to_array($compare, false), is_object($value) || is_resource($value));
}
return false;
}
function twig_escape_filter(Twig_Environment $env, $string, $strategy ='html', $charset = null, $autoescape = false)
{
if ($autoescape && $string instanceof Twig_Markup) {
return $string;
}
if (!is_string($string)) {
if (is_object($string) && method_exists($string,'__toString')) {
$string = (string) $string;
} elseif (in_array($strategy, array('html','js','css','html_attr','url'))) {
return $string;
}
}
if (null === $charset) {
$charset = $env->getCharset();
}
switch ($strategy) {
case'html':
static $htmlspecialcharsCharsets;
if (null === $htmlspecialcharsCharsets) {
if (defined('HHVM_VERSION')) {
$htmlspecialcharsCharsets = array('utf-8'=> true,'UTF-8'=> true);
} else {
$htmlspecialcharsCharsets = array('ISO-8859-1'=> true,'ISO8859-1'=> true,'ISO-8859-15'=> true,'ISO8859-15'=> true,'utf-8'=> true,'UTF-8'=> true,'CP866'=> true,'IBM866'=> true,'866'=> true,'CP1251'=> true,'WINDOWS-1251'=> true,'WIN-1251'=> true,'1251'=> true,'CP1252'=> true,'WINDOWS-1252'=> true,'1252'=> true,'KOI8-R'=> true,'KOI8-RU'=> true,'KOI8R'=> true,'BIG5'=> true,'950'=> true,'GB2312'=> true,'936'=> true,'BIG5-HKSCS'=> true,'SHIFT_JIS'=> true,'SJIS'=> true,'932'=> true,'EUC-JP'=> true,'EUCJP'=> true,'ISO8859-5'=> true,'ISO-8859-5'=> true,'MACROMAN'=> true,
);
}
}
if (isset($htmlspecialcharsCharsets[$charset])) {
return htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE, $charset);
}
if (isset($htmlspecialcharsCharsets[strtoupper($charset)])) {
$htmlspecialcharsCharsets[$charset] = true;
return htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE, $charset);
}
$string = twig_convert_encoding($string,'UTF-8', $charset);
$string = htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8');
return twig_convert_encoding($string, $charset,'UTF-8');
case'js':
if ('UTF-8'!== $charset) {
$string = twig_convert_encoding($string,'UTF-8', $charset);
}
if (0 == strlen($string) ? false : (1 == preg_match('/^./su', $string) ? false : true)) {
throw new Twig_Error_Runtime('The string to escape is not a valid UTF-8 string.');
}
$string = preg_replace_callback('#[^a-zA-Z0-9,\._]#Su','_twig_escape_js_callback', $string);
if ('UTF-8'!== $charset) {
$string = twig_convert_encoding($string, $charset,'UTF-8');
}
return $string;
case'css':
if ('UTF-8'!== $charset) {
$string = twig_convert_encoding($string,'UTF-8', $charset);
}
if (0 == strlen($string) ? false : (1 == preg_match('/^./su', $string) ? false : true)) {
throw new Twig_Error_Runtime('The string to escape is not a valid UTF-8 string.');
}
$string = preg_replace_callback('#[^a-zA-Z0-9]#Su','_twig_escape_css_callback', $string);
if ('UTF-8'!== $charset) {
$string = twig_convert_encoding($string, $charset,'UTF-8');
}
return $string;
case'html_attr':
if ('UTF-8'!== $charset) {
$string = twig_convert_encoding($string,'UTF-8', $charset);
}
if (0 == strlen($string) ? false : (1 == preg_match('/^./su', $string) ? false : true)) {
throw new Twig_Error_Runtime('The string to escape is not a valid UTF-8 string.');
}
$string = preg_replace_callback('#[^a-zA-Z0-9,\.\-_]#Su','_twig_escape_html_attr_callback', $string);
if ('UTF-8'!== $charset) {
$string = twig_convert_encoding($string, $charset,'UTF-8');
}
return $string;
case'url':
if (PHP_VERSION_ID < 50300) {
return str_replace('%7E','~', rawurlencode($string));
}
return rawurlencode($string);
default:
static $escapers;
if (null === $escapers) {
$escapers = $env->getExtension('core')->getEscapers();
}
if (isset($escapers[$strategy])) {
return call_user_func($escapers[$strategy], $env, $string, $charset);
}
$validStrategies = implode(', ', array_merge(array('html','js','url','css','html_attr'), array_keys($escapers)));
throw new Twig_Error_Runtime(sprintf('Invalid escaping strategy "%s" (valid ones: %s).', $strategy, $validStrategies));
}
}
function twig_escape_filter_is_safe(Twig_Node $filterArgs)
{
foreach ($filterArgs as $arg) {
if ($arg instanceof Twig_Node_Expression_Constant) {
return array($arg->getAttribute('value'));
}
return array();
}
return array('html');
}
if (function_exists('mb_convert_encoding')) {
function twig_convert_encoding($string, $to, $from)
{
return mb_convert_encoding($string, $to, $from);
}
} elseif (function_exists('iconv')) {
function twig_convert_encoding($string, $to, $from)
{
return iconv($from, $to, $string);
}
} else {
function twig_convert_encoding($string, $to, $from)
{
throw new Twig_Error_Runtime('No suitable convert encoding function (use UTF-8 as your encoding or install the iconv or mbstring extension).');
}
}
function _twig_escape_js_callback($matches)
{
$char = $matches[0];
if (!isset($char[1])) {
return'\\x'.strtoupper(substr('00'.bin2hex($char), -2));
}
$char = twig_convert_encoding($char,'UTF-16BE','UTF-8');
return'\\u'.strtoupper(substr('0000'.bin2hex($char), -4));
}
function _twig_escape_css_callback($matches)
{
$char = $matches[0];
if (!isset($char[1])) {
$hex = ltrim(strtoupper(bin2hex($char)),'0');
if (0 === strlen($hex)) {
$hex ='0';
}
return'\\'.$hex.' ';
}
$char = twig_convert_encoding($char,'UTF-16BE','UTF-8');
return'\\'.ltrim(strtoupper(bin2hex($char)),'0').' ';
}
function _twig_escape_html_attr_callback($matches)
{
static $entityMap = array(
34 =>'quot',
38 =>'amp',
60 =>'lt',
62 =>'gt',
);
$chr = $matches[0];
$ord = ord($chr);
if (($ord <= 0x1f && $chr !="\t"&& $chr !="\n"&& $chr !="\r") || ($ord >= 0x7f && $ord <= 0x9f)) {
return'&#xFFFD;';
}
if (strlen($chr) == 1) {
$hex = strtoupper(substr('00'.bin2hex($chr), -2));
} else {
$chr = twig_convert_encoding($chr,'UTF-16BE','UTF-8');
$hex = strtoupper(substr('0000'.bin2hex($chr), -4));
}
$int = hexdec($hex);
if (array_key_exists($int, $entityMap)) {
return sprintf('&%s;', $entityMap[$int]);
}
return sprintf('&#x%s;', $hex);
}
if (function_exists('mb_get_info')) {
function twig_length_filter(Twig_Environment $env, $thing)
{
return is_scalar($thing) ? mb_strlen($thing, $env->getCharset()) : count($thing);
}
function twig_upper_filter(Twig_Environment $env, $string)
{
if (null !== $charset = $env->getCharset()) {
return mb_strtoupper($string, $charset);
}
return strtoupper($string);
}
function twig_lower_filter(Twig_Environment $env, $string)
{
if (null !== $charset = $env->getCharset()) {
return mb_strtolower($string, $charset);
}
return strtolower($string);
}
function twig_title_string_filter(Twig_Environment $env, $string)
{
if (null !== $charset = $env->getCharset()) {
return mb_convert_case($string, MB_CASE_TITLE, $charset);
}
return ucwords(strtolower($string));
}
function twig_capitalize_string_filter(Twig_Environment $env, $string)
{
if (null !== $charset = $env->getCharset()) {
return mb_strtoupper(mb_substr($string, 0, 1, $charset), $charset).mb_strtolower(mb_substr($string, 1, mb_strlen($string, $charset), $charset), $charset);
}
return ucfirst(strtolower($string));
}
}
else {
function twig_length_filter(Twig_Environment $env, $thing)
{
return is_scalar($thing) ? strlen($thing) : count($thing);
}
function twig_title_string_filter(Twig_Environment $env, $string)
{
return ucwords(strtolower($string));
}
function twig_capitalize_string_filter(Twig_Environment $env, $string)
{
return ucfirst(strtolower($string));
}
}
function twig_ensure_traversable($seq)
{
if ($seq instanceof Traversable || is_array($seq)) {
return $seq;
}
return array();
}
function twig_test_empty($value)
{
if ($value instanceof Countable) {
return 0 == count($value);
}
return''=== $value || false === $value || null === $value || array() === $value;
}
function twig_test_iterable($value)
{
return $value instanceof Traversable || is_array($value);
}
function twig_include(Twig_Environment $env, $context, $template, $variables = array(), $withContext = true, $ignoreMissing = false, $sandboxed = false)
{
$alreadySandboxed = false;
$sandbox = null;
if ($withContext) {
$variables = array_merge($context, $variables);
}
if ($isSandboxed = $sandboxed && $env->hasExtension('sandbox')) {
$sandbox = $env->getExtension('sandbox');
if (!$alreadySandboxed = $sandbox->isSandboxed()) {
$sandbox->enableSandbox();
}
}
$result = null;
try {
$result = $env->resolveTemplate($template)->render($variables);
} catch (Twig_Error_Loader $e) {
if (!$ignoreMissing) {
if ($isSandboxed && !$alreadySandboxed) {
$sandbox->disableSandbox();
}
throw $e;
}
}
if ($isSandboxed && !$alreadySandboxed) {
$sandbox->disableSandbox();
}
return $result;
}
function twig_source(Twig_Environment $env, $name, $ignoreMissing = false)
{
try {
return $env->getLoader()->getSource($name);
} catch (Twig_Error_Loader $e) {
if (!$ignoreMissing) {
throw $e;
}
}
}
function twig_constant($constant, $object = null)
{
if (null !== $object) {
$constant = get_class($object).'::'.$constant;
}
return constant($constant);
}
function twig_array_batch($items, $size, $fill = null)
{
if ($items instanceof Traversable) {
$items = iterator_to_array($items, false);
}
$size = ceil($size);
$result = array_chunk($items, $size, true);
if (null !== $fill && !empty($result)) {
$last = count($result) - 1;
if ($fillCount = $size - count($result[$last])) {
$result[$last] = array_merge(
$result[$last],
array_fill(0, $fillCount, $fill)
);
}
}
return $result;
}
}
namespace
{
class Twig_Extension_Escaper extends Twig_Extension
{
protected $defaultStrategy;
public function __construct($defaultStrategy ='html')
{
$this->setDefaultStrategy($defaultStrategy);
}
public function getTokenParsers()
{
return array(new Twig_TokenParser_AutoEscape());
}
public function getNodeVisitors()
{
return array(new Twig_NodeVisitor_Escaper());
}
public function getFilters()
{
return array(
new Twig_SimpleFilter('raw','twig_raw_filter', array('is_safe'=> array('all'))),
);
}
public function setDefaultStrategy($defaultStrategy)
{
if (true === $defaultStrategy) {
@trigger_error('Using "true" as the default strategy is deprecated since version 1.21. Use "html" instead.', E_USER_DEPRECATED);
$defaultStrategy ='html';
}
if ('filename'=== $defaultStrategy) {
$defaultStrategy = array('Twig_FileExtensionEscapingStrategy','guess');
}
$this->defaultStrategy = $defaultStrategy;
}
public function getDefaultStrategy($filename)
{
if (!is_string($this->defaultStrategy) && false !== $this->defaultStrategy) {
return call_user_func($this->defaultStrategy, $filename);
}
return $this->defaultStrategy;
}
public function getName()
{
return'escaper';
}
}
function twig_raw_filter($string)
{
return $string;
}
}
namespace
{
class Twig_Extension_Optimizer extends Twig_Extension
{
protected $optimizers;
public function __construct($optimizers = -1)
{
$this->optimizers = $optimizers;
}
public function getNodeVisitors()
{
return array(new Twig_NodeVisitor_Optimizer($this->optimizers));
}
public function getName()
{
return'optimizer';
}
}
}
namespace
{
interface Twig_LoaderInterface
{
public function getSource($name);
public function getCacheKey($name);
public function isFresh($name, $time);
}
}
namespace
{
class Twig_Markup implements Countable
{
protected $content;
protected $charset;
public function __construct($content, $charset)
{
$this->content = (string) $content;
$this->charset = $charset;
}
public function __toString()
{
return $this->content;
}
public function count()
{
return function_exists('mb_get_info') ? mb_strlen($this->content, $this->charset) : strlen($this->content);
}
}
}
namespace
{
interface Twig_TemplateInterface
{
const ANY_CALL ='any';
const ARRAY_CALL ='array';
const METHOD_CALL ='method';
public function render(array $context);
public function display(array $context, array $blocks = array());
public function getEnvironment();
}
}
namespace
{
abstract class Twig_Template implements Twig_TemplateInterface
{
protected static $cache = array();
protected $parent;
protected $parents = array();
protected $env;
protected $blocks = array();
protected $traits = array();
public function __construct(Twig_Environment $env)
{
$this->env = $env;
}
abstract public function getTemplateName();
public function getEnvironment()
{
@trigger_error('The '.__METHOD__.' method is deprecated since version 1.20 and will be removed in 2.0.', E_USER_DEPRECATED);
return $this->env;
}
public function getParent(array $context)
{
if (null !== $this->parent) {
return $this->parent;
}
try {
$parent = $this->doGetParent($context);
if (false === $parent) {
return false;
}
if ($parent instanceof self) {
return $this->parents[$parent->getTemplateName()] = $parent;
}
if (!isset($this->parents[$parent])) {
$this->parents[$parent] = $this->loadTemplate($parent);
}
} catch (Twig_Error_Loader $e) {
$e->setTemplateFile(null);
$e->guess();
throw $e;
}
return $this->parents[$parent];
}
protected function doGetParent(array $context)
{
return false;
}
public function isTraitable()
{
return true;
}
public function displayParentBlock($name, array $context, array $blocks = array())
{
$name = (string) $name;
if (isset($this->traits[$name])) {
$this->traits[$name][0]->displayBlock($name, $context, $blocks, false);
} elseif (false !== $parent = $this->getParent($context)) {
$parent->displayBlock($name, $context, $blocks, false);
} else {
throw new Twig_Error_Runtime(sprintf('The template has no parent and no traits defining the "%s" block', $name), -1, $this->getTemplateName());
}
}
public function displayBlock($name, array $context, array $blocks = array(), $useBlocks = true)
{
$name = (string) $name;
if ($useBlocks && isset($blocks[$name])) {
$template = $blocks[$name][0];
$block = $blocks[$name][1];
} elseif (isset($this->blocks[$name])) {
$template = $this->blocks[$name][0];
$block = $this->blocks[$name][1];
} else {
$template = null;
$block = null;
}
if (null !== $template) {
if (!$template instanceof self) {
throw new LogicException('A block must be a method on a Twig_Template instance.');
}
try {
$template->$block($context, $blocks);
} catch (Twig_Error $e) {
if (!$e->getTemplateFile()) {
$e->setTemplateFile($template->getTemplateName());
}
if (false === $e->getTemplateLine()) {
$e->setTemplateLine(-1);
$e->guess();
}
throw $e;
} catch (Exception $e) {
throw new Twig_Error_Runtime(sprintf('An exception has been thrown during the rendering of a template ("%s").', $e->getMessage()), -1, $template->getTemplateName(), $e);
}
} elseif (false !== $parent = $this->getParent($context)) {
$parent->displayBlock($name, $context, array_merge($this->blocks, $blocks), false);
}
}
public function renderParentBlock($name, array $context, array $blocks = array())
{
ob_start();
$this->displayParentBlock($name, $context, $blocks);
return ob_get_clean();
}
public function renderBlock($name, array $context, array $blocks = array(), $useBlocks = true)
{
ob_start();
$this->displayBlock($name, $context, $blocks, $useBlocks);
return ob_get_clean();
}
public function hasBlock($name)
{
return isset($this->blocks[(string) $name]);
}
public function getBlockNames()
{
return array_keys($this->blocks);
}
protected function loadTemplate($template, $templateName = null, $line = null, $index = null)
{
try {
if (is_array($template)) {
return $this->env->resolveTemplate($template);
}
if ($template instanceof self) {
return $template;
}
return $this->env->loadTemplate($template, $index);
} catch (Twig_Error $e) {
if (!$e->getTemplateFile()) {
$e->setTemplateFile($templateName ? $templateName : $this->getTemplateName());
}
if ($e->getTemplateLine()) {
throw $e;
}
if (!$line) {
$e->guess();
} else {
$e->setTemplateLine($line);
}
throw $e;
}
}
public function getBlocks()
{
return $this->blocks;
}
public function getSource()
{
$reflector = new ReflectionClass($this);
$file = $reflector->getFileName();
if (!file_exists($file)) {
return;
}
$source = file($file, FILE_IGNORE_NEW_LINES);
array_splice($source, 0, $reflector->getEndLine());
$i = 0;
while (isset($source[$i]) &&'/* */'=== substr_replace($source[$i],'', 3, -2)) {
$source[$i] = str_replace('*//* ','*/', substr($source[$i], 3, -2));
++$i;
}
array_splice($source, $i);
return implode("\n", $source);
}
public function display(array $context, array $blocks = array())
{
$this->displayWithErrorHandling($this->env->mergeGlobals($context), array_merge($this->blocks, $blocks));
}
public function render(array $context)
{
$level = ob_get_level();
ob_start();
try {
$this->display($context);
} catch (Exception $e) {
while (ob_get_level() > $level) {
ob_end_clean();
}
throw $e;
} catch (Throwable $e) {
while (ob_get_level() > $level) {
ob_end_clean();
}
throw $e;
}
return ob_get_clean();
}
protected function displayWithErrorHandling(array $context, array $blocks = array())
{
try {
$this->doDisplay($context, $blocks);
} catch (Twig_Error $e) {
if (!$e->getTemplateFile()) {
$e->setTemplateFile($this->getTemplateName());
}
if (false === $e->getTemplateLine()) {
$e->setTemplateLine(-1);
$e->guess();
}
throw $e;
} catch (Exception $e) {
throw new Twig_Error_Runtime(sprintf('An exception has been thrown during the rendering of a template ("%s").', $e->getMessage()), -1, $this->getTemplateName(), $e);
}
}
abstract protected function doDisplay(array $context, array $blocks = array());
final protected function getContext($context, $item, $ignoreStrictCheck = false)
{
if (!array_key_exists($item, $context)) {
if ($ignoreStrictCheck || !$this->env->isStrictVariables()) {
return;
}
throw new Twig_Error_Runtime(sprintf('Variable "%s" does not exist', $item), -1, $this->getTemplateName());
}
return $context[$item];
}
protected function getAttribute($object, $item, array $arguments = array(), $type = self::ANY_CALL, $isDefinedTest = false, $ignoreStrictCheck = false)
{
if (self::METHOD_CALL !== $type) {
$arrayItem = is_bool($item) || is_float($item) ? (int) $item : $item;
if ((is_array($object) && array_key_exists($arrayItem, $object))
|| ($object instanceof ArrayAccess && isset($object[$arrayItem]))
) {
if ($isDefinedTest) {
return true;
}
return $object[$arrayItem];
}
if (self::ARRAY_CALL === $type || !is_object($object)) {
if ($isDefinedTest) {
return false;
}
if ($ignoreStrictCheck || !$this->env->isStrictVariables()) {
return;
}
if ($object instanceof ArrayAccess) {
$message = sprintf('Key "%s" in object with ArrayAccess of class "%s" does not exist', $arrayItem, get_class($object));
} elseif (is_object($object)) {
$message = sprintf('Impossible to access a key "%s" on an object of class "%s" that does not implement ArrayAccess interface', $item, get_class($object));
} elseif (is_array($object)) {
if (empty($object)) {
$message = sprintf('Key "%s" does not exist as the array is empty', $arrayItem);
} else {
$message = sprintf('Key "%s" for array with keys "%s" does not exist', $arrayItem, implode(', ', array_keys($object)));
}
} elseif (self::ARRAY_CALL === $type) {
if (null === $object) {
$message = sprintf('Impossible to access a key ("%s") on a null variable', $item);
} else {
$message = sprintf('Impossible to access a key ("%s") on a %s variable ("%s")', $item, gettype($object), $object);
}
} elseif (null === $object) {
$message = sprintf('Impossible to access an attribute ("%s") on a null variable', $item);
} else {
$message = sprintf('Impossible to access an attribute ("%s") on a %s variable ("%s")', $item, gettype($object), $object);
}
throw new Twig_Error_Runtime($message, -1, $this->getTemplateName());
}
}
if (!is_object($object)) {
if ($isDefinedTest) {
return false;
}
if ($ignoreStrictCheck || !$this->env->isStrictVariables()) {
return;
}
if (null === $object) {
$message = sprintf('Impossible to invoke a method ("%s") on a null variable', $item);
} else {
$message = sprintf('Impossible to invoke a method ("%s") on a %s variable ("%s")', $item, gettype($object), $object);
}
throw new Twig_Error_Runtime($message, -1, $this->getTemplateName());
}
if (self::METHOD_CALL !== $type && !$object instanceof self) { if (isset($object->$item) || array_key_exists((string) $item, $object)) {
if ($isDefinedTest) {
return true;
}
if ($this->env->hasExtension('sandbox')) {
$this->env->getExtension('sandbox')->checkPropertyAllowed($object, $item);
}
return $object->$item;
}
}
$class = get_class($object);
if (!isset(self::$cache[$class]['methods'])) {
if ($object instanceof self) {
$ref = new ReflectionClass($class);
$methods = array();
foreach ($ref->getMethods(ReflectionMethod::IS_PUBLIC) as $refMethod) {
$methodName = strtolower($refMethod->name);
if ('getenvironment'!== $methodName) {
$methods[$methodName] = true;
}
}
self::$cache[$class]['methods'] = $methods;
} else {
self::$cache[$class]['methods'] = array_change_key_case(array_flip(get_class_methods($object)));
}
}
$call = false;
$lcItem = strtolower($item);
if (isset(self::$cache[$class]['methods'][$lcItem])) {
$method = (string) $item;
} elseif (isset(self::$cache[$class]['methods']['get'.$lcItem])) {
$method ='get'.$item;
} elseif (isset(self::$cache[$class]['methods']['is'.$lcItem])) {
$method ='is'.$item;
} elseif (isset(self::$cache[$class]['methods']['__call'])) {
$method = (string) $item;
$call = true;
} else {
if ($isDefinedTest) {
return false;
}
if ($ignoreStrictCheck || !$this->env->isStrictVariables()) {
return;
}
throw new Twig_Error_Runtime(sprintf('Neither the property "%1$s" nor one of the methods "%1$s()", "get%1$s()"/"is%1$s()" or "__call()" exist and have public access in class "%2$s"', $item, get_class($object)), -1, $this->getTemplateName());
}
if ($isDefinedTest) {
return true;
}
if ($this->env->hasExtension('sandbox')) {
$this->env->getExtension('sandbox')->checkMethodAllowed($object, $method);
}
try {
$ret = call_user_func_array(array($object, $method), $arguments);
} catch (BadMethodCallException $e) {
if ($call && ($ignoreStrictCheck || !$this->env->isStrictVariables())) {
return;
}
throw $e;
}
if ($object instanceof Twig_TemplateInterface) {
return $ret ===''?'': new Twig_Markup($ret, $this->env->getCharset());
}
return $ret;
}
}
}
namespace Monolog\Formatter
{
interface FormatterInterface
{
public function format(array $record);
public function formatBatch(array $records);
}
}
namespace Monolog\Formatter
{
use Exception;
class NormalizerFormatter implements FormatterInterface
{
const SIMPLE_DATE ="Y-m-d H:i:s";
protected $dateFormat;
public function __construct($dateFormat = null)
{
$this->dateFormat = $dateFormat ?: static::SIMPLE_DATE;
if (!function_exists('json_encode')) {
throw new \RuntimeException('PHP\'s json extension is required to use Monolog\'s NormalizerFormatter');
}
}
public function format(array $record)
{
return $this->normalize($record);
}
public function formatBatch(array $records)
{
foreach ($records as $key => $record) {
$records[$key] = $this->format($record);
}
return $records;
}
protected function normalize($data)
{
if (null === $data || is_scalar($data)) {
if (is_float($data)) {
if (is_infinite($data)) {
return ($data > 0 ?'':'-') .'INF';
}
if (is_nan($data)) {
return'NaN';
}
}
return $data;
}
if (is_array($data) || $data instanceof \Traversable) {
$normalized = array();
$count = 1;
foreach ($data as $key => $value) {
if ($count++ >= 1000) {
$normalized['...'] ='Over 1000 items, aborting normalization';
break;
}
$normalized[$key] = $this->normalize($value);
}
return $normalized;
}
if ($data instanceof \DateTime) {
return $data->format($this->dateFormat);
}
if (is_object($data)) {
if ($data instanceof Exception || (PHP_VERSION_ID > 70000 && $data instanceof \Throwable)) {
return $this->normalizeException($data);
}
if (method_exists($data,'__toString') && !$data instanceof \JsonSerializable) {
$value = $data->__toString();
} else {
$value = $this->toJson($data, true);
}
return sprintf("[object] (%s: %s)", get_class($data), $value);
}
if (is_resource($data)) {
return sprintf('[resource] (%s)', get_resource_type($data));
}
return'[unknown('.gettype($data).')]';
}
protected function normalizeException($e)
{
if (!$e instanceof Exception && !$e instanceof \Throwable) {
throw new \InvalidArgumentException('Exception/Throwable expected, got '.gettype($e).' / '.get_class($e));
}
$data = array('class'=> get_class($e),'message'=> $e->getMessage(),'code'=> $e->getCode(),'file'=> $e->getFile().':'.$e->getLine(),
);
if ($e instanceof \SoapFault) {
if (isset($e->faultcode)) {
$data['faultcode'] = $e->faultcode;
}
if (isset($e->faultactor)) {
$data['faultactor'] = $e->faultactor;
}
if (isset($e->detail)) {
$data['detail'] = $e->detail;
}
}
$trace = $e->getTrace();
foreach ($trace as $frame) {
if (isset($frame['file'])) {
$data['trace'][] = $frame['file'].':'.$frame['line'];
} elseif (isset($frame['function']) && $frame['function'] ==='{closure}') {
$data['trace'][] = $frame['function'];
} else {
$data['trace'][] = $this->toJson($this->normalize($frame), true);
}
}
if ($previous = $e->getPrevious()) {
$data['previous'] = $this->normalizeException($previous);
}
return $data;
}
protected function toJson($data, $ignoreErrors = false)
{
if ($ignoreErrors) {
return @$this->jsonEncode($data);
}
$json = $this->jsonEncode($data);
if ($json === false) {
$json = $this->handleJsonError(json_last_error(), $data);
}
return $json;
}
private function jsonEncode($data)
{
if (version_compare(PHP_VERSION,'5.4.0','>=')) {
return json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
}
return json_encode($data);
}
private function handleJsonError($code, $data)
{
if ($code !== JSON_ERROR_UTF8) {
$this->throwEncodeError($code, $data);
}
if (is_string($data)) {
$this->detectAndCleanUtf8($data);
} elseif (is_array($data)) {
array_walk_recursive($data, array($this,'detectAndCleanUtf8'));
} else {
$this->throwEncodeError($code, $data);
}
$json = $this->jsonEncode($data);
if ($json === false) {
$this->throwEncodeError(json_last_error(), $data);
}
return $json;
}
private function throwEncodeError($code, $data)
{
switch ($code) {
case JSON_ERROR_DEPTH:
$msg ='Maximum stack depth exceeded';
break;
case JSON_ERROR_STATE_MISMATCH:
$msg ='Underflow or the modes mismatch';
break;
case JSON_ERROR_CTRL_CHAR:
$msg ='Unexpected control character found';
break;
case JSON_ERROR_UTF8:
$msg ='Malformed UTF-8 characters, possibly incorrectly encoded';
break;
default:
$msg ='Unknown error';
}
throw new \RuntimeException('JSON encoding failed: '.$msg.'. Encoding: '.var_export($data, true));
}
public function detectAndCleanUtf8(&$data)
{
if (is_string($data) && !preg_match('//u', $data)) {
$data = preg_replace_callback('/[\x80-\xFF]+/',
function ($m) { return utf8_encode($m[0]); },
$data
);
$data = str_replace(
array('¤','¦','¨','´','¸','¼','½','¾'),
array('€','Š','š','Ž','ž','Œ','œ','Ÿ'),
$data
);
}
}
}
}
namespace Monolog\Formatter
{
class LineFormatter extends NormalizerFormatter
{
const SIMPLE_FORMAT ="[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n";
protected $format;
protected $allowInlineLineBreaks;
protected $ignoreEmptyContextAndExtra;
protected $includeStacktraces;
public function __construct($format = null, $dateFormat = null, $allowInlineLineBreaks = false, $ignoreEmptyContextAndExtra = false)
{
$this->format = $format ?: static::SIMPLE_FORMAT;
$this->allowInlineLineBreaks = $allowInlineLineBreaks;
$this->ignoreEmptyContextAndExtra = $ignoreEmptyContextAndExtra;
parent::__construct($dateFormat);
}
public function includeStacktraces($include = true)
{
$this->includeStacktraces = $include;
if ($this->includeStacktraces) {
$this->allowInlineLineBreaks = true;
}
}
public function allowInlineLineBreaks($allow = true)
{
$this->allowInlineLineBreaks = $allow;
}
public function ignoreEmptyContextAndExtra($ignore = true)
{
$this->ignoreEmptyContextAndExtra = $ignore;
}
public function format(array $record)
{
$vars = parent::format($record);
$output = $this->format;
foreach ($vars['extra'] as $var => $val) {
if (false !== strpos($output,'%extra.'.$var.'%')) {
$output = str_replace('%extra.'.$var.'%', $this->stringify($val), $output);
unset($vars['extra'][$var]);
}
}
foreach ($vars['context'] as $var => $val) {
if (false !== strpos($output,'%context.'.$var.'%')) {
$output = str_replace('%context.'.$var.'%', $this->stringify($val), $output);
unset($vars['context'][$var]);
}
}
if ($this->ignoreEmptyContextAndExtra) {
if (empty($vars['context'])) {
unset($vars['context']);
$output = str_replace('%context%','', $output);
}
if (empty($vars['extra'])) {
unset($vars['extra']);
$output = str_replace('%extra%','', $output);
}
}
foreach ($vars as $var => $val) {
if (false !== strpos($output,'%'.$var.'%')) {
$output = str_replace('%'.$var.'%', $this->stringify($val), $output);
}
}
return $output;
}
public function formatBatch(array $records)
{
$message ='';
foreach ($records as $record) {
$message .= $this->format($record);
}
return $message;
}
public function stringify($value)
{
return $this->replaceNewlines($this->convertToString($value));
}
protected function normalizeException($e)
{
if (!$e instanceof \Exception && !$e instanceof \Throwable) {
throw new \InvalidArgumentException('Exception/Throwable expected, got '.gettype($e).' / '.get_class($e));
}
$previousText ='';
if ($previous = $e->getPrevious()) {
do {
$previousText .=', '.get_class($previous).'(code: '.$previous->getCode().'): '.$previous->getMessage().' at '.$previous->getFile().':'.$previous->getLine();
} while ($previous = $previous->getPrevious());
}
$str ='[object] ('.get_class($e).'(code: '.$e->getCode().'): '.$e->getMessage().' at '.$e->getFile().':'.$e->getLine().$previousText.')';
if ($this->includeStacktraces) {
$str .="\n[stacktrace]\n".$e->getTraceAsString();
}
return $str;
}
protected function convertToString($data)
{
if (null === $data || is_bool($data)) {
return var_export($data, true);
}
if (is_scalar($data)) {
return (string) $data;
}
if (version_compare(PHP_VERSION,'5.4.0','>=')) {
return $this->toJson($data, true);
}
return str_replace('\\/','/', @json_encode($data));
}
protected function replaceNewlines($str)
{
if ($this->allowInlineLineBreaks) {
return $str;
}
return str_replace(array("\r\n","\r","\n"),' ', $str);
}
}
}
namespace Monolog\Handler
{
use Monolog\Formatter\FormatterInterface;
interface HandlerInterface
{
public function isHandling(array $record);
public function handle(array $record);
public function handleBatch(array $records);
public function pushProcessor($callback);
public function popProcessor();
public function setFormatter(FormatterInterface $formatter);
public function getFormatter();
}
}
namespace Monolog\Handler
{
use Monolog\Logger;
use Monolog\Formatter\FormatterInterface;
use Monolog\Formatter\LineFormatter;
abstract class AbstractHandler implements HandlerInterface
{
protected $level = Logger::DEBUG;
protected $bubble = true;
protected $formatter;
protected $processors = array();
public function __construct($level = Logger::DEBUG, $bubble = true)
{
$this->setLevel($level);
$this->bubble = $bubble;
}
public function isHandling(array $record)
{
return $record['level'] >= $this->level;
}
public function handleBatch(array $records)
{
foreach ($records as $record) {
$this->handle($record);
}
}
public function close()
{
}
public function pushProcessor($callback)
{
if (!is_callable($callback)) {
throw new \InvalidArgumentException('Processors must be valid callables (callback or object with an __invoke method), '.var_export($callback, true).' given');
}
array_unshift($this->processors, $callback);
return $this;
}
public function popProcessor()
{
if (!$this->processors) {
throw new \LogicException('You tried to pop from an empty processor stack.');
}
return array_shift($this->processors);
}
public function setFormatter(FormatterInterface $formatter)
{
$this->formatter = $formatter;
return $this;
}
public function getFormatter()
{
if (!$this->formatter) {
$this->formatter = $this->getDefaultFormatter();
}
return $this->formatter;
}
public function setLevel($level)
{
$this->level = Logger::toMonologLevel($level);
return $this;
}
public function getLevel()
{
return $this->level;
}
public function setBubble($bubble)
{
$this->bubble = $bubble;
return $this;
}
public function getBubble()
{
return $this->bubble;
}
public function __destruct()
{
try {
$this->close();
} catch (\Exception $e) {
} catch (\Throwable $e) {
}
}
protected function getDefaultFormatter()
{
return new LineFormatter();
}
}
}
namespace Monolog\Handler
{
abstract class AbstractProcessingHandler extends AbstractHandler
{
public function handle(array $record)
{
if (!$this->isHandling($record)) {
return false;
}
$record = $this->processRecord($record);
$record['formatted'] = $this->getFormatter()->format($record);
$this->write($record);
return false === $this->bubble;
}
abstract protected function write(array $record);
protected function processRecord(array $record)
{
if ($this->processors) {
foreach ($this->processors as $processor) {
$record = call_user_func($processor, $record);
}
}
return $record;
}
}
}
namespace Monolog\Handler
{
use Monolog\Logger;
class StreamHandler extends AbstractProcessingHandler
{
protected $stream;
protected $url;
private $errorMessage;
protected $filePermission;
protected $useLocking;
private $dirCreated;
public function __construct($stream, $level = Logger::DEBUG, $bubble = true, $filePermission = null, $useLocking = false)
{
parent::__construct($level, $bubble);
if (is_resource($stream)) {
$this->stream = $stream;
} elseif (is_string($stream)) {
$this->url = $stream;
} else {
throw new \InvalidArgumentException('A stream must either be a resource or a string.');
}
$this->filePermission = $filePermission;
$this->useLocking = $useLocking;
}
public function close()
{
if ($this->url && is_resource($this->stream)) {
fclose($this->stream);
}
$this->stream = null;
}
public function getStream()
{
return $this->stream;
}
public function getUrl()
{
return $this->url;
}
protected function write(array $record)
{
if (!is_resource($this->stream)) {
if (null === $this->url ||''=== $this->url) {
throw new \LogicException('Missing stream url, the stream can not be opened. This may be caused by a premature call to close().');
}
$this->createDir();
$this->errorMessage = null;
set_error_handler(array($this,'customErrorHandler'));
$this->stream = fopen($this->url,'a');
if ($this->filePermission !== null) {
@chmod($this->url, $this->filePermission);
}
restore_error_handler();
if (!is_resource($this->stream)) {
$this->stream = null;
throw new \UnexpectedValueException(sprintf('The stream or file "%s" could not be opened: '.$this->errorMessage, $this->url));
}
}
if ($this->useLocking) {
flock($this->stream, LOCK_EX);
}
fwrite($this->stream, (string) $record['formatted']);
if ($this->useLocking) {
flock($this->stream, LOCK_UN);
}
}
private function customErrorHandler($code, $msg)
{
$this->errorMessage = preg_replace('{^(fopen|mkdir)\(.*?\): }','', $msg);
}
private function getDirFromStream($stream)
{
$pos = strpos($stream,'://');
if ($pos === false) {
return dirname($stream);
}
if ('file://'=== substr($stream, 0, 7)) {
return dirname(substr($stream, 7));
}
return;
}
private function createDir()
{
if ($this->dirCreated) {
return;
}
$dir = $this->getDirFromStream($this->url);
if (null !== $dir && !is_dir($dir)) {
$this->errorMessage = null;
set_error_handler(array($this,'customErrorHandler'));
$status = mkdir($dir, 0777, true);
restore_error_handler();
if (false === $status) {
throw new \UnexpectedValueException(sprintf('There is no existing directory at "%s" and its not buildable: '.$this->errorMessage, $dir));
}
}
$this->dirCreated = true;
}
}
}
namespace Monolog\Handler
{
use Monolog\Handler\FingersCrossed\ErrorLevelActivationStrategy;
use Monolog\Handler\FingersCrossed\ActivationStrategyInterface;
use Monolog\Logger;
class FingersCrossedHandler extends AbstractHandler
{
protected $handler;
protected $activationStrategy;
protected $buffering = true;
protected $bufferSize;
protected $buffer = array();
protected $stopBuffering;
protected $passthruLevel;
public function __construct($handler, $activationStrategy = null, $bufferSize = 0, $bubble = true, $stopBuffering = true, $passthruLevel = null)
{
if (null === $activationStrategy) {
$activationStrategy = new ErrorLevelActivationStrategy(Logger::WARNING);
}
if (!$activationStrategy instanceof ActivationStrategyInterface) {
$activationStrategy = new ErrorLevelActivationStrategy($activationStrategy);
}
$this->handler = $handler;
$this->activationStrategy = $activationStrategy;
$this->bufferSize = $bufferSize;
$this->bubble = $bubble;
$this->stopBuffering = $stopBuffering;
if ($passthruLevel !== null) {
$this->passthruLevel = Logger::toMonologLevel($passthruLevel);
}
if (!$this->handler instanceof HandlerInterface && !is_callable($this->handler)) {
throw new \RuntimeException("The given handler (".json_encode($this->handler).") is not a callable nor a Monolog\Handler\HandlerInterface object");
}
}
public function isHandling(array $record)
{
return true;
}
public function activate()
{
if ($this->stopBuffering) {
$this->buffering = false;
}
if (!$this->handler instanceof HandlerInterface) {
$record = end($this->buffer) ?: null;
$this->handler = call_user_func($this->handler, $record, $this);
if (!$this->handler instanceof HandlerInterface) {
throw new \RuntimeException("The factory callable should return a HandlerInterface");
}
}
$this->handler->handleBatch($this->buffer);
$this->buffer = array();
}
public function handle(array $record)
{
if ($this->processors) {
foreach ($this->processors as $processor) {
$record = call_user_func($processor, $record);
}
}
if ($this->buffering) {
$this->buffer[] = $record;
if ($this->bufferSize > 0 && count($this->buffer) > $this->bufferSize) {
array_shift($this->buffer);
}
if ($this->activationStrategy->isHandlerActivated($record)) {
$this->activate();
}
} else {
$this->handler->handle($record);
}
return false === $this->bubble;
}
public function close()
{
if (null !== $this->passthruLevel) {
$level = $this->passthruLevel;
$this->buffer = array_filter($this->buffer, function ($record) use ($level) {
return $record['level'] >= $level;
});
if (count($this->buffer) > 0) {
$this->handler->handleBatch($this->buffer);
$this->buffer = array();
}
}
}
public function reset()
{
$this->buffering = true;
}
public function clear()
{
$this->buffer = array();
$this->reset();
}
}
}
namespace Monolog\Handler
{
use Monolog\Logger;
class FilterHandler extends AbstractHandler
{
protected $handler;
protected $acceptedLevels;
protected $bubble;
public function __construct($handler, $minLevelOrList = Logger::DEBUG, $maxLevel = Logger::EMERGENCY, $bubble = true)
{
$this->handler = $handler;
$this->bubble = $bubble;
$this->setAcceptedLevels($minLevelOrList, $maxLevel);
if (!$this->handler instanceof HandlerInterface && !is_callable($this->handler)) {
throw new \RuntimeException("The given handler (".json_encode($this->handler).") is not a callable nor a Monolog\Handler\HandlerInterface object");
}
}
public function getAcceptedLevels()
{
return array_flip($this->acceptedLevels);
}
public function setAcceptedLevels($minLevelOrList = Logger::DEBUG, $maxLevel = Logger::EMERGENCY)
{
if (is_array($minLevelOrList)) {
$acceptedLevels = array_map('Monolog\Logger::toMonologLevel', $minLevelOrList);
} else {
$minLevelOrList = Logger::toMonologLevel($minLevelOrList);
$maxLevel = Logger::toMonologLevel($maxLevel);
$acceptedLevels = array_values(array_filter(Logger::getLevels(), function ($level) use ($minLevelOrList, $maxLevel) {
return $level >= $minLevelOrList && $level <= $maxLevel;
}));
}
$this->acceptedLevels = array_flip($acceptedLevels);
}
public function isHandling(array $record)
{
return isset($this->acceptedLevels[$record['level']]);
}
public function handle(array $record)
{
if (!$this->isHandling($record)) {
return false;
}
if (!$this->handler instanceof HandlerInterface) {
$this->handler = call_user_func($this->handler, $record, $this);
if (!$this->handler instanceof HandlerInterface) {
throw new \RuntimeException("The factory callable should return a HandlerInterface");
}
}
if ($this->processors) {
foreach ($this->processors as $processor) {
$record = call_user_func($processor, $record);
}
}
$this->handler->handle($record);
return false === $this->bubble;
}
public function handleBatch(array $records)
{
$filtered = array();
foreach ($records as $record) {
if ($this->isHandling($record)) {
$filtered[] = $record;
}
}
$this->handler->handleBatch($filtered);
}
}
}
namespace Monolog\Handler
{
class TestHandler extends AbstractProcessingHandler
{
protected $records = array();
protected $recordsByLevel = array();
public function getRecords()
{
return $this->records;
}
public function clear()
{
$this->records = array();
$this->recordsByLevel = array();
}
protected function hasRecordRecords($level)
{
return isset($this->recordsByLevel[$level]);
}
protected function hasRecord($record, $level)
{
if (is_array($record)) {
$record = $record['message'];
}
return $this->hasRecordThatPasses(function ($rec) use ($record) {
return $rec['message'] === $record;
}, $level);
}
public function hasRecordThatContains($message, $level)
{
return $this->hasRecordThatPasses(function ($rec) use ($message) {
return strpos($rec['message'], $message) !== false;
}, $level);
}
public function hasRecordThatMatches($regex, $level)
{
return $this->hasRecordThatPasses(function ($rec) use ($regex) {
return preg_match($regex, $rec['message']) > 0;
}, $level);
}
public function hasRecordThatPasses($predicate, $level)
{
if (!is_callable($predicate)) {
throw new \InvalidArgumentException("Expected a callable for hasRecordThatSucceeds");
}
if (!isset($this->recordsByLevel[$level])) {
return false;
}
foreach ($this->recordsByLevel[$level] as $i => $rec) {
if (call_user_func($predicate, $rec, $i)) {
return true;
}
}
return false;
}
protected function write(array $record)
{
$this->recordsByLevel[$record['level']][] = $record;
$this->records[] = $record;
}
public function __call($method, $args)
{
if (preg_match('/(.*)(Debug|Info|Notice|Warning|Error|Critical|Alert|Emergency)(.*)/', $method, $matches) > 0) {
$genericMethod = $matches[1] .'Record'. $matches[3];
$level = constant('Monolog\Logger::'. strtoupper($matches[2]));
if (method_exists($this, $genericMethod)) {
$args[] = $level;
return call_user_func_array(array($this, $genericMethod), $args);
}
}
throw new \BadMethodCallException('Call to undefined method '. get_class($this) .'::'. $method .'()');
}
}
}
namespace Monolog
{
use Monolog\Handler\HandlerInterface;
use Monolog\Handler\StreamHandler;
use Psr\Log\LoggerInterface;
use Psr\Log\InvalidArgumentException;
class Logger implements LoggerInterface
{
const DEBUG = 100;
const INFO = 200;
const NOTICE = 250;
const WARNING = 300;
const ERROR = 400;
const CRITICAL = 500;
const ALERT = 550;
const EMERGENCY = 600;
const API = 1;
protected static $levels = array(
self::DEBUG =>'DEBUG',
self::INFO =>'INFO',
self::NOTICE =>'NOTICE',
self::WARNING =>'WARNING',
self::ERROR =>'ERROR',
self::CRITICAL =>'CRITICAL',
self::ALERT =>'ALERT',
self::EMERGENCY =>'EMERGENCY',
);
protected static $timezone;
protected $name;
protected $handlers;
protected $processors;
protected $microsecondTimestamps = true;
public function __construct($name, array $handlers = array(), array $processors = array())
{
$this->name = $name;
$this->handlers = $handlers;
$this->processors = $processors;
}
public function getName()
{
return $this->name;
}
public function withName($name)
{
$new = clone $this;
$new->name = $name;
return $new;
}
public function pushHandler(HandlerInterface $handler)
{
array_unshift($this->handlers, $handler);
return $this;
}
public function popHandler()
{
if (!$this->handlers) {
throw new \LogicException('You tried to pop from an empty handler stack.');
}
return array_shift($this->handlers);
}
public function setHandlers(array $handlers)
{
$this->handlers = array();
foreach (array_reverse($handlers) as $handler) {
$this->pushHandler($handler);
}
return $this;
}
public function getHandlers()
{
return $this->handlers;
}
public function pushProcessor($callback)
{
if (!is_callable($callback)) {
throw new \InvalidArgumentException('Processors must be valid callables (callback or object with an __invoke method), '.var_export($callback, true).' given');
}
array_unshift($this->processors, $callback);
return $this;
}
public function popProcessor()
{
if (!$this->processors) {
throw new \LogicException('You tried to pop from an empty processor stack.');
}
return array_shift($this->processors);
}
public function getProcessors()
{
return $this->processors;
}
public function useMicrosecondTimestamps($micro)
{
$this->microsecondTimestamps = (bool) $micro;
}
public function addRecord($level, $message, array $context = array())
{
if (!$this->handlers) {
$this->pushHandler(new StreamHandler('php://stderr', static::DEBUG));
}
$levelName = static::getLevelName($level);
$handlerKey = null;
reset($this->handlers);
while ($handler = current($this->handlers)) {
if ($handler->isHandling(array('level'=> $level))) {
$handlerKey = key($this->handlers);
break;
}
next($this->handlers);
}
if (null === $handlerKey) {
return false;
}
if (!static::$timezone) {
static::$timezone = new \DateTimeZone(date_default_timezone_get() ?:'UTC');
}
if ($this->microsecondTimestamps) {
$ts = \DateTime::createFromFormat('U.u', sprintf('%.6F', microtime(true)), static::$timezone);
} else {
$ts = new \DateTime(null, static::$timezone);
}
$ts->setTimezone(static::$timezone);
$record = array('message'=> (string) $message,'context'=> $context,'level'=> $level,'level_name'=> $levelName,'channel'=> $this->name,'datetime'=> $ts,'extra'=> array(),
);
foreach ($this->processors as $processor) {
$record = call_user_func($processor, $record);
}
while ($handler = current($this->handlers)) {
if (true === $handler->handle($record)) {
break;
}
next($this->handlers);
}
return true;
}
public function addDebug($message, array $context = array())
{
return $this->addRecord(static::DEBUG, $message, $context);
}
public function addInfo($message, array $context = array())
{
return $this->addRecord(static::INFO, $message, $context);
}
public function addNotice($message, array $context = array())
{
return $this->addRecord(static::NOTICE, $message, $context);
}
public function addWarning($message, array $context = array())
{
return $this->addRecord(static::WARNING, $message, $context);
}
public function addError($message, array $context = array())
{
return $this->addRecord(static::ERROR, $message, $context);
}
public function addCritical($message, array $context = array())
{
return $this->addRecord(static::CRITICAL, $message, $context);
}
public function addAlert($message, array $context = array())
{
return $this->addRecord(static::ALERT, $message, $context);
}
public function addEmergency($message, array $context = array())
{
return $this->addRecord(static::EMERGENCY, $message, $context);
}
public static function getLevels()
{
return array_flip(static::$levels);
}
public static function getLevelName($level)
{
if (!isset(static::$levels[$level])) {
throw new InvalidArgumentException('Level "'.$level.'" is not defined, use one of: '.implode(', ', array_keys(static::$levels)));
}
return static::$levels[$level];
}
public static function toMonologLevel($level)
{
if (is_string($level) && defined(__CLASS__.'::'.strtoupper($level))) {
return constant(__CLASS__.'::'.strtoupper($level));
}
return $level;
}
public function isHandling($level)
{
$record = array('level'=> $level,
);
foreach ($this->handlers as $handler) {
if ($handler->isHandling($record)) {
return true;
}
}
return false;
}
public function log($level, $message, array $context = array())
{
$level = static::toMonologLevel($level);
return $this->addRecord($level, $message, $context);
}
public function debug($message, array $context = array())
{
return $this->addRecord(static::DEBUG, $message, $context);
}
public function info($message, array $context = array())
{
return $this->addRecord(static::INFO, $message, $context);
}
public function notice($message, array $context = array())
{
return $this->addRecord(static::NOTICE, $message, $context);
}
public function warn($message, array $context = array())
{
return $this->addRecord(static::WARNING, $message, $context);
}
public function warning($message, array $context = array())
{
return $this->addRecord(static::WARNING, $message, $context);
}
public function err($message, array $context = array())
{
return $this->addRecord(static::ERROR, $message, $context);
}
public function error($message, array $context = array())
{
return $this->addRecord(static::ERROR, $message, $context);
}
public function crit($message, array $context = array())
{
return $this->addRecord(static::CRITICAL, $message, $context);
}
public function critical($message, array $context = array())
{
return $this->addRecord(static::CRITICAL, $message, $context);
}
public function alert($message, array $context = array())
{
return $this->addRecord(static::ALERT, $message, $context);
}
public function emerg($message, array $context = array())
{
return $this->addRecord(static::EMERGENCY, $message, $context);
}
public function emergency($message, array $context = array())
{
return $this->addRecord(static::EMERGENCY, $message, $context);
}
public static function setTimezone(\DateTimeZone $tz)
{
self::$timezone = $tz;
}
}
}
namespace Symfony\Component\HttpKernel\Log
{
use Psr\Log\LoggerInterface as PsrLogger;
interface LoggerInterface extends PsrLogger
{
public function emerg($message, array $context = array());
public function crit($message, array $context = array());
public function err($message, array $context = array());
public function warn($message, array $context = array());
}
}
namespace Symfony\Component\HttpKernel\Log
{
interface DebugLoggerInterface
{
public function getLogs();
public function countErrors();
}
}
namespace Symfony\Bridge\Monolog
{
use Monolog\Logger as BaseLogger;
use Symfony\Component\HttpKernel\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;
class Logger extends BaseLogger implements LoggerInterface, DebugLoggerInterface
{
public function emerg($message, array $context = array())
{
@trigger_error('The '.__METHOD__.' method inherited from the Symfony\Component\HttpKernel\Log\LoggerInterface interface is deprecated since version 2.2 and will be removed in 3.0. Use the emergency() method instead, which is PSR-3 compatible.', E_USER_DEPRECATED);
return parent::addRecord(BaseLogger::EMERGENCY, $message, $context);
}
public function crit($message, array $context = array())
{
@trigger_error('The '.__METHOD__.' method inherited from the Symfony\Component\HttpKernel\Log\LoggerInterface interface is deprecated since version 2.2 and will be removed in 3.0. Use the method critical() method instead, which is PSR-3 compatible.', E_USER_DEPRECATED);
return parent::addRecord(BaseLogger::CRITICAL, $message, $context);
}
public function err($message, array $context = array())
{
@trigger_error('The '.__METHOD__.' method inherited from the Symfony\Component\HttpKernel\Log\LoggerInterface interface is deprecated since version 2.2 and will be removed in 3.0. Use the error() method instead, which is PSR-3 compatible.', E_USER_DEPRECATED);
return parent::addRecord(BaseLogger::ERROR, $message, $context);
}
public function warn($message, array $context = array())
{
@trigger_error('The '.__METHOD__.' method inherited from the Symfony\Component\HttpKernel\Log\LoggerInterface interface is deprecated since version 2.2 and will be removed in 3.0. Use the warning() method instead, which is PSR-3 compatible.', E_USER_DEPRECATED);
return parent::addRecord(BaseLogger::WARNING, $message, $context);
}
public function getLogs()
{
if ($logger = $this->getDebugLogger()) {
return $logger->getLogs();
}
return array();
}
public function countErrors()
{
if ($logger = $this->getDebugLogger()) {
return $logger->countErrors();
}
return 0;
}
private function getDebugLogger()
{
foreach ($this->handlers as $handler) {
if ($handler instanceof DebugLoggerInterface) {
return $handler;
}
}
}
}
}
namespace Symfony\Bridge\Monolog\Handler
{
use Monolog\Logger;
use Monolog\Handler\TestHandler;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;
class DebugHandler extends TestHandler implements DebugLoggerInterface
{
public function getLogs()
{
$records = array();
foreach ($this->records as $record) {
$records[] = array('timestamp'=> $record['datetime']->getTimestamp(),'message'=> $record['message'],'priority'=> $record['level'],'priorityName'=> $record['level_name'],'context'=> $record['context'],'channel'=> isset($record['channel']) ? $record['channel'] :'',
);
}
return $records;
}
public function countErrors()
{
$cnt = 0;
$levels = array(Logger::ERROR, Logger::CRITICAL, Logger::ALERT, Logger::EMERGENCY);
foreach ($levels as $level) {
if (isset($this->recordsByLevel[$level])) {
$cnt += count($this->recordsByLevel[$level]);
}
}
return $cnt;
}
}
}
namespace Monolog\Handler\FingersCrossed
{
interface ActivationStrategyInterface
{
public function isHandlerActivated(array $record);
}
}
namespace Monolog\Handler\FingersCrossed
{
use Monolog\Logger;
class ErrorLevelActivationStrategy implements ActivationStrategyInterface
{
private $actionLevel;
public function __construct($actionLevel)
{
$this->actionLevel = Logger::toMonologLevel($actionLevel);
}
public function isHandlerActivated(array $record)
{
return $record['level'] >= $this->actionLevel;
}
}
}
namespace Assetic
{
interface ValueSupplierInterface
{
public function getValues();
}
}
namespace Symfony\Bundle\AsseticBundle
{
use Assetic\ValueSupplierInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
class DefaultValueSupplier implements ValueSupplierInterface
{
protected $container;
public function __construct(ContainerInterface $container)
{
$this->container = $container;
}
public function getValues()
{
$request = $this->getCurrentRequest();
if (!$request) {
return array();
}
return array('locale'=> $request->getLocale(),'env'=> $this->container->getParameter('kernel.environment'),
);
}
private function getCurrentRequest()
{
$request = null;
$requestStack = $this->container->get('request_stack', ContainerInterface::NULL_ON_INVALID_REFERENCE);
if ($requestStack) {
$request = $requestStack->getCurrentRequest();
} elseif ($this->container->isScopeActive('request')) {
$request = $this->container->get('request');
}
return $request;
}
}
}
namespace Assetic\Factory
{
use Assetic\Asset\AssetCollection;
use Assetic\Asset\AssetCollectionInterface;
use Assetic\Asset\AssetInterface;
use Assetic\Asset\AssetReference;
use Assetic\Asset\FileAsset;
use Assetic\Asset\GlobAsset;
use Assetic\Asset\HttpAsset;
use Assetic\AssetManager;
use Assetic\Factory\Worker\WorkerInterface;
use Assetic\Filter\DependencyExtractorInterface;
use Assetic\FilterManager;
class AssetFactory
{
private $root;
private $debug;
private $output;
private $workers;
private $am;
private $fm;
public function __construct($root, $debug = false)
{
$this->root = rtrim($root,'/');
$this->debug = $debug;
$this->output ='assetic/*';
$this->workers = array();
}
public function setDebug($debug)
{
$this->debug = $debug;
}
public function isDebug()
{
return $this->debug;
}
public function setDefaultOutput($output)
{
$this->output = $output;
}
public function addWorker(WorkerInterface $worker)
{
$this->workers[] = $worker;
}
public function getAssetManager()
{
return $this->am;
}
public function setAssetManager(AssetManager $am)
{
$this->am = $am;
}
public function getFilterManager()
{
return $this->fm;
}
public function setFilterManager(FilterManager $fm)
{
$this->fm = $fm;
}
public function createAsset($inputs = array(), $filters = array(), array $options = array())
{
if (!is_array($inputs)) {
$inputs = array($inputs);
}
if (!is_array($filters)) {
$filters = array($filters);
}
if (!isset($options['output'])) {
$options['output'] = $this->output;
}
if (!isset($options['vars'])) {
$options['vars'] = array();
}
if (!isset($options['debug'])) {
$options['debug'] = $this->debug;
}
if (!isset($options['root'])) {
$options['root'] = array($this->root);
} else {
if (!is_array($options['root'])) {
$options['root'] = array($options['root']);
}
$options['root'][] = $this->root;
}
if (!isset($options['name'])) {
$options['name'] = $this->generateAssetName($inputs, $filters, $options);
}
$asset = $this->createAssetCollection(array(), $options);
$extensions = array();
foreach ($inputs as $input) {
if (is_array($input)) {
$asset->add(call_user_func_array(array($this,'createAsset'), $input));
} else {
$asset->add($this->parseInput($input, $options));
$extensions[pathinfo($input, PATHINFO_EXTENSION)] = true;
}
}
foreach ($filters as $filter) {
if ('?'!= $filter[0]) {
$asset->ensureFilter($this->getFilter($filter));
} elseif (!$options['debug']) {
$asset->ensureFilter($this->getFilter(substr($filter, 1)));
}
}
if (!empty($options['vars'])) {
$toAdd = array();
foreach ($options['vars'] as $var) {
if (false !== strpos($options['output'],'{'.$var.'}')) {
continue;
}
$toAdd[] ='{'.$var.'}';
}
if ($toAdd) {
$options['output'] = str_replace('*','*.'.implode('.', $toAdd), $options['output']);
}
}
if (1 == count($extensions) && !pathinfo($options['output'], PATHINFO_EXTENSION) && $extension = key($extensions)) {
$options['output'] .='.'.$extension;
}
$asset->setTargetPath(str_replace('*', $options['name'], $options['output']));
return $this->applyWorkers($asset);
}
public function generateAssetName($inputs, $filters, $options = array())
{
foreach (array_diff(array_keys($options), array('output','debug','root')) as $key) {
unset($options[$key]);
}
ksort($options);
return substr(sha1(serialize($inputs).serialize($filters).serialize($options)), 0, 7);
}
public function getLastModified(AssetInterface $asset)
{
$mtime = 0;
foreach ($asset instanceof AssetCollectionInterface ? $asset : array($asset) as $leaf) {
$mtime = max($mtime, $leaf->getLastModified());
if (!$filters = $leaf->getFilters()) {
continue;
}
$prevFilters = array();
foreach ($filters as $filter) {
$prevFilters[] = $filter;
if (!$filter instanceof DependencyExtractorInterface) {
continue;
}
$clone = clone $leaf;
$clone->clearFilters();
foreach (array_slice($prevFilters, 0, -1) as $prevFilter) {
$clone->ensureFilter($prevFilter);
}
$clone->load();
foreach ($filter->getChildren($this, $clone->getContent(), $clone->getSourceDirectory()) as $child) {
$mtime = max($mtime, $this->getLastModified($child));
}
}
}
return $mtime;
}
protected function parseInput($input, array $options = array())
{
if ('@'== $input[0]) {
return $this->createAssetReference(substr($input, 1));
}
if (false !== strpos($input,'://') || 0 === strpos($input,'//')) {
return $this->createHttpAsset($input, $options['vars']);
}
if (self::isAbsolutePath($input)) {
if ($root = self::findRootDir($input, $options['root'])) {
$path = ltrim(substr($input, strlen($root)),'/');
} else {
$path = null;
}
} else {
$root = $this->root;
$path = $input;
$input = $this->root.'/'.$path;
}
if (false !== strpos($input,'*')) {
return $this->createGlobAsset($input, $root, $options['vars']);
}
return $this->createFileAsset($input, $root, $path, $options['vars']);
}
protected function createAssetCollection(array $assets = array(), array $options = array())
{
return new AssetCollection($assets, array(), null, isset($options['vars']) ? $options['vars'] : array());
}
protected function createAssetReference($name)
{
if (!$this->am) {
throw new \LogicException('There is no asset manager.');
}
return new AssetReference($this->am, $name);
}
protected function createHttpAsset($sourceUrl, $vars)
{
return new HttpAsset($sourceUrl, array(), false, $vars);
}
protected function createGlobAsset($glob, $root = null, $vars)
{
return new GlobAsset($glob, array(), $root, $vars);
}
protected function createFileAsset($source, $root = null, $path = null, $vars)
{
return new FileAsset($source, array(), $root, $path, $vars);
}
protected function getFilter($name)
{
if (!$this->fm) {
throw new \LogicException('There is no filter manager.');
}
return $this->fm->get($name);
}
private function applyWorkers(AssetCollectionInterface $asset)
{
foreach ($asset as $leaf) {
foreach ($this->workers as $worker) {
$retval = $worker->process($leaf, $this);
if ($retval instanceof AssetInterface && $leaf !== $retval) {
$asset->replaceLeaf($leaf, $retval);
}
}
}
foreach ($this->workers as $worker) {
$retval = $worker->process($asset, $this);
if ($retval instanceof AssetInterface) {
$asset = $retval;
}
}
return $asset instanceof AssetCollectionInterface ? $asset : $this->createAssetCollection(array($asset));
}
private static function isAbsolutePath($path)
{
return'/'== $path[0] ||'\\'== $path[0] || (3 < strlen($path) && ctype_alpha($path[0]) && $path[1] ==':'&& ('\\'== $path[2] ||'/'== $path[2]));
}
private static function findRootDir($path, array $roots)
{
foreach ($roots as $root) {
if (0 === strpos($path, $root)) {
return $root;
}
}
}
}
}
namespace Symfony\Bundle\AsseticBundle\Factory
{
use Assetic\Factory\AssetFactory as BaseAssetFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpKernel\KernelInterface;
class AssetFactory extends BaseAssetFactory
{
private $kernel;
private $container;
private $parameterBag;
public function __construct(KernelInterface $kernel, ContainerInterface $container, ParameterBagInterface $parameterBag, $baseDir, $debug = false)
{
$this->kernel = $kernel;
$this->container = $container;
$this->parameterBag = $parameterBag;
parent::__construct($baseDir, $debug);
}
protected function parseInput($input, array $options = array())
{
$input = $this->parameterBag->resolveValue($input);
if ('@'== $input[0] && false !== strpos($input,'/')) {
$bundle = substr($input, 1);
if (false !== $pos = strpos($bundle,'/')) {
$bundle = substr($bundle, 0, $pos);
}
$options['root'] = array($this->kernel->getBundle($bundle)->getPath());
if (false !== $pos = strpos($input,'*')) {
list($before, $after) = explode('*', $input, 2);
$input = $this->kernel->locateResource($before).'*'.$after;
} else {
$input = $this->kernel->locateResource($input);
}
}
return parent::parseInput($input, $options);
}
protected function createAssetReference($name)
{
if (!$this->getAssetManager()) {
$this->setAssetManager($this->container->get('assetic.asset_manager'));
}
return parent::createAssetReference($name);
}
protected function getFilter($name)
{
if (!$this->getFilterManager()) {
$this->setFilterManager($this->container->get('assetic.filter_manager'));
}
return parent::getFilter($name);
}
}
}
namespace Doctrine\Common\Lexer
{
abstract class AbstractLexer
{
private $input;
private $tokens = array();
private $position = 0;
private $peek = 0;
public $lookahead;
public $token;
public function setInput($input)
{
$this->input = $input;
$this->tokens = array();
$this->reset();
$this->scan($input);
}
public function reset()
{
$this->lookahead = null;
$this->token = null;
$this->peek = 0;
$this->position = 0;
}
public function resetPeek()
{
$this->peek = 0;
}
public function resetPosition($position = 0)
{
$this->position = $position;
}
public function getInputUntilPosition($position)
{
return substr($this->input, 0, $position);
}
public function isNextToken($token)
{
return null !== $this->lookahead && $this->lookahead['type'] === $token;
}
public function isNextTokenAny(array $tokens)
{
return null !== $this->lookahead && in_array($this->lookahead['type'], $tokens, true);
}
public function moveNext()
{
$this->peek = 0;
$this->token = $this->lookahead;
$this->lookahead = (isset($this->tokens[$this->position]))
? $this->tokens[$this->position++] : null;
return $this->lookahead !== null;
}
public function skipUntil($type)
{
while ($this->lookahead !== null && $this->lookahead['type'] !== $type) {
$this->moveNext();
}
}
public function isA($value, $token)
{
return $this->getType($value) === $token;
}
public function peek()
{
if (isset($this->tokens[$this->position + $this->peek])) {
return $this->tokens[$this->position + $this->peek++];
} else {
return null;
}
}
public function glimpse()
{
$peek = $this->peek();
$this->peek = 0;
return $peek;
}
protected function scan($input)
{
static $regex;
if ( ! isset($regex)) {
$regex = sprintf('/(%s)|%s/%s',
implode(')|(', $this->getCatchablePatterns()),
implode('|', $this->getNonCatchablePatterns()),
$this->getModifiers()
);
}
$flags = PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_OFFSET_CAPTURE;
$matches = preg_split($regex, $input, -1, $flags);
foreach ($matches as $match) {
$type = $this->getType($match[0]);
$this->tokens[] = array('value'=> $match[0],'type'=> $type,'position'=> $match[1],
);
}
}
public function getLiteral($token)
{
$className = get_class($this);
$reflClass = new \ReflectionClass($className);
$constants = $reflClass->getConstants();
foreach ($constants as $name => $value) {
if ($value === $token) {
return $className .'::'. $name;
}
}
return $token;
}
protected function getModifiers()
{
return'i';
}
abstract protected function getCatchablePatterns();
abstract protected function getNonCatchablePatterns();
abstract protected function getType(&$value);
}
}
namespace Doctrine\Common\Annotations
{
use Doctrine\Common\Lexer\AbstractLexer;
final class DocLexer extends AbstractLexer
{
const T_NONE = 1;
const T_INTEGER = 2;
const T_STRING = 3;
const T_FLOAT = 4;
const T_IDENTIFIER = 100;
const T_AT = 101;
const T_CLOSE_CURLY_BRACES = 102;
const T_CLOSE_PARENTHESIS = 103;
const T_COMMA = 104;
const T_EQUALS = 105;
const T_FALSE = 106;
const T_NAMESPACE_SEPARATOR = 107;
const T_OPEN_CURLY_BRACES = 108;
const T_OPEN_PARENTHESIS = 109;
const T_TRUE = 110;
const T_NULL = 111;
const T_COLON = 112;
protected $noCase = array('@'=> self::T_AT,','=> self::T_COMMA,'('=> self::T_OPEN_PARENTHESIS,')'=> self::T_CLOSE_PARENTHESIS,'{'=> self::T_OPEN_CURLY_BRACES,'}'=> self::T_CLOSE_CURLY_BRACES,'='=> self::T_EQUALS,':'=> self::T_COLON,'\\'=> self::T_NAMESPACE_SEPARATOR
);
protected $withCase = array('true'=> self::T_TRUE,'false'=> self::T_FALSE,'null'=> self::T_NULL
);
protected function getCatchablePatterns()
{
return array('[a-z_\\\][a-z0-9_\:\\\]*[a-z_][a-z0-9_]*','(?:[+-]?[0-9]+(?:[\.][0-9]+)*)(?:[eE][+-]?[0-9]+)?','"(?:""|[^"])*+"',
);
}
protected function getNonCatchablePatterns()
{
return array('\s+','\*+','(.)');
}
protected function getType(&$value)
{
$type = self::T_NONE;
if ($value[0] ==='"') {
$value = str_replace('""','"', substr($value, 1, strlen($value) - 2));
return self::T_STRING;
}
if (isset($this->noCase[$value])) {
return $this->noCase[$value];
}
if ($value[0] ==='_'|| $value[0] ==='\\'|| ctype_alpha($value[0])) {
return self::T_IDENTIFIER;
}
$lowerValue = strtolower($value);
if (isset($this->withCase[$lowerValue])) {
return $this->withCase[$lowerValue];
}
if (is_numeric($value)) {
return (strpos($value,'.') !== false || stripos($value,'e') !== false)
? self::T_FLOAT : self::T_INTEGER;
}
return $type;
}
}
}
namespace Doctrine\Common\Annotations
{
interface Reader
{
function getClassAnnotations(\ReflectionClass $class);
function getClassAnnotation(\ReflectionClass $class, $annotationName);
function getMethodAnnotations(\ReflectionMethod $method);
function getMethodAnnotation(\ReflectionMethod $method, $annotationName);
function getPropertyAnnotations(\ReflectionProperty $property);
function getPropertyAnnotation(\ReflectionProperty $property, $annotationName);
}
}
namespace Doctrine\Common\Annotations
{
class FileCacheReader implements Reader
{
private $reader;
private $dir;
private $debug;
private $loadedAnnotations = array();
private $classNameHashes = array();
private $umask;
public function __construct(Reader $reader, $cacheDir, $debug = false, $umask = 0002)
{
if ( ! is_int($umask)) {
throw new \InvalidArgumentException(sprintf('The parameter umask must be an integer, was: %s',
gettype($umask)
));
}
$this->reader = $reader;
$this->umask = $umask;
if (!is_dir($cacheDir) && !@mkdir($cacheDir, 0777 & (~$this->umask), true)) {
throw new \InvalidArgumentException(sprintf('The directory "%s" does not exist and could not be created.', $cacheDir));
}
$this->dir = rtrim($cacheDir,'\\/');
$this->debug = $debug;
}
public function getClassAnnotations(\ReflectionClass $class)
{
if ( ! isset($this->classNameHashes[$class->name])) {
$this->classNameHashes[$class->name] = sha1($class->name);
}
$key = $this->classNameHashes[$class->name];
if (isset($this->loadedAnnotations[$key])) {
return $this->loadedAnnotations[$key];
}
$path = $this->dir.'/'.strtr($key,'\\','-').'.cache.php';
if (!is_file($path)) {
$annot = $this->reader->getClassAnnotations($class);
$this->saveCacheFile($path, $annot);
return $this->loadedAnnotations[$key] = $annot;
}
if ($this->debug
&& (false !== $filename = $class->getFilename())
&& filemtime($path) < filemtime($filename)) {
@unlink($path);
$annot = $this->reader->getClassAnnotations($class);
$this->saveCacheFile($path, $annot);
return $this->loadedAnnotations[$key] = $annot;
}
return $this->loadedAnnotations[$key] = include $path;
}
public function getPropertyAnnotations(\ReflectionProperty $property)
{
$class = $property->getDeclaringClass();
if ( ! isset($this->classNameHashes[$class->name])) {
$this->classNameHashes[$class->name] = sha1($class->name);
}
$key = $this->classNameHashes[$class->name].'$'.$property->getName();
if (isset($this->loadedAnnotations[$key])) {
return $this->loadedAnnotations[$key];
}
$path = $this->dir.'/'.strtr($key,'\\','-').'.cache.php';
if (!is_file($path)) {
$annot = $this->reader->getPropertyAnnotations($property);
$this->saveCacheFile($path, $annot);
return $this->loadedAnnotations[$key] = $annot;
}
if ($this->debug
&& (false !== $filename = $class->getFilename())
&& filemtime($path) < filemtime($filename)) {
@unlink($path);
$annot = $this->reader->getPropertyAnnotations($property);
$this->saveCacheFile($path, $annot);
return $this->loadedAnnotations[$key] = $annot;
}
return $this->loadedAnnotations[$key] = include $path;
}
public function getMethodAnnotations(\ReflectionMethod $method)
{
$class = $method->getDeclaringClass();
if ( ! isset($this->classNameHashes[$class->name])) {
$this->classNameHashes[$class->name] = sha1($class->name);
}
$key = $this->classNameHashes[$class->name].'#'.$method->getName();
if (isset($this->loadedAnnotations[$key])) {
return $this->loadedAnnotations[$key];
}
$path = $this->dir.'/'.strtr($key,'\\','-').'.cache.php';
if (!is_file($path)) {
$annot = $this->reader->getMethodAnnotations($method);
$this->saveCacheFile($path, $annot);
return $this->loadedAnnotations[$key] = $annot;
}
if ($this->debug
&& (false !== $filename = $class->getFilename())
&& filemtime($path) < filemtime($filename)) {
@unlink($path);
$annot = $this->reader->getMethodAnnotations($method);
$this->saveCacheFile($path, $annot);
return $this->loadedAnnotations[$key] = $annot;
}
return $this->loadedAnnotations[$key] = include $path;
}
private function saveCacheFile($path, $data)
{
if (!is_writable($this->dir)) {
throw new \InvalidArgumentException(sprintf('The directory "%s" is not writable. Both, the webserver and the console user need access. You can manage access rights for multiple users with "chmod +a". If your system does not support this, check out the acl package.', $this->dir));
}
$tempfile = tempnam($this->dir, uniqid('', true));
if (false === $tempfile) {
throw new \RuntimeException(sprintf('Unable to create tempfile in directory: %s', $this->dir));
}
$written = file_put_contents($tempfile,'<?php return unserialize('.var_export(serialize($data), true).');');
if (false === $written) {
throw new \RuntimeException(sprintf('Unable to write cached file to: %s', $tempfile));
}
@chmod($tempfile, 0666 & (~$this->umask));
if (false === rename($tempfile, $path)) {
@unlink($tempfile);
throw new \RuntimeException(sprintf('Unable to rename %s to %s', $tempfile, $path));
}
}
public function getClassAnnotation(\ReflectionClass $class, $annotationName)
{
$annotations = $this->getClassAnnotations($class);
foreach ($annotations as $annotation) {
if ($annotation instanceof $annotationName) {
return $annotation;
}
}
return null;
}
public function getMethodAnnotation(\ReflectionMethod $method, $annotationName)
{
$annotations = $this->getMethodAnnotations($method);
foreach ($annotations as $annotation) {
if ($annotation instanceof $annotationName) {
return $annotation;
}
}
return null;
}
public function getPropertyAnnotation(\ReflectionProperty $property, $annotationName)
{
$annotations = $this->getPropertyAnnotations($property);
foreach ($annotations as $annotation) {
if ($annotation instanceof $annotationName) {
return $annotation;
}
}
return null;
}
public function clearLoadedAnnotations()
{
$this->loadedAnnotations = array();
}
}
}
namespace Doctrine\Common\Annotations
{
use SplFileObject;
final class PhpParser
{
public function parseClass(\ReflectionClass $class)
{
if (method_exists($class,'getUseStatements')) {
return $class->getUseStatements();
}
if (false === $filename = $class->getFilename()) {
return array();
}
$content = $this->getFileContent($filename, $class->getStartLine());
if (null === $content) {
return array();
}
$namespace = preg_quote($class->getNamespaceName());
$content = preg_replace('/^.*?(\bnamespace\s+'. $namespace .'\s*[;{].*)$/s','\\1', $content);
$tokenizer = new TokenParser('<?php '. $content);
$statements = $tokenizer->parseUseStatements($class->getNamespaceName());
return $statements;
}
private function getFileContent($filename, $lineNumber)
{
if ( ! is_file($filename)) {
return null;
}
$content ='';
$lineCnt = 0;
$file = new SplFileObject($filename);
while (!$file->eof()) {
if ($lineCnt++ == $lineNumber) {
break;
}
$content .= $file->fgets();
}
return $content;
}
}
}
namespace Doctrine\Common
{
use Doctrine\Common\Lexer\AbstractLexer;
abstract class Lexer extends AbstractLexer
{
}
}
namespace Doctrine\Common\Persistence
{
interface ConnectionRegistry
{
public function getDefaultConnectionName();
public function getConnection($name = null);
public function getConnections();
public function getConnectionNames();
}
}
namespace Doctrine\Common\Persistence
{
interface Proxy
{
const MARKER ='__CG__';
const MARKER_LENGTH = 6;
public function __load();
public function __isInitialized();
}
}
namespace Doctrine\Common\Util
{
use Doctrine\Common\Persistence\Proxy;
class ClassUtils
{
public static function getRealClass($class)
{
if (false === $pos = strrpos($class,'\\'.Proxy::MARKER.'\\')) {
return $class;
}
return substr($class, $pos + Proxy::MARKER_LENGTH + 2);
}
public static function getClass($object)
{
return self::getRealClass(get_class($object));
}
public static function getParentClass($className)
{
return get_parent_class( self::getRealClass( $className ) );
}
public static function newReflectionClass($class)
{
return new \ReflectionClass( self::getRealClass( $class ) );
}
public static function newReflectionObject($object)
{
return self::newReflectionClass( self::getClass( $object ) );
}
public static function generateProxyClassName($className, $proxyNamespace)
{
return rtrim($proxyNamespace,'\\') .'\\'.Proxy::MARKER.'\\'. ltrim($className,'\\');
}
}
}
namespace Symfony\Component\DependencyInjection
{
interface ContainerAwareInterface
{
public function setContainer(ContainerInterface $container = null);
}
}
namespace Doctrine\Common\Persistence
{
interface ManagerRegistry extends ConnectionRegistry
{
public function getDefaultManagerName();
public function getManager($name = null);
public function getManagers();
public function resetManager($name = null);
public function getAliasNamespace($alias);
public function getManagerNames();
public function getRepository($persistentObject, $persistentManagerName = null);
public function getManagerForClass($class);
}
}
namespace Symfony\Bridge\Doctrine
{
use Doctrine\Common\Persistence\ManagerRegistry as ManagerRegistryInterface;
use Doctrine\ORM\EntityManager;
interface RegistryInterface extends ManagerRegistryInterface
{
public function getDefaultEntityManagerName();
public function getEntityManager($name = null);
public function getEntityManagers();
public function resetEntityManager($name = null);
public function getEntityNamespace($alias);
public function getEntityManagerNames();
public function getEntityManagerForClass($class);
}
}
namespace Doctrine\Common\Persistence
{
abstract class AbstractManagerRegistry implements ManagerRegistry
{
private $name;
private $connections;
private $managers;
private $defaultConnection;
private $defaultManager;
private $proxyInterfaceName;
public function __construct($name, array $connections, array $managers, $defaultConnection, $defaultManager, $proxyInterfaceName)
{
$this->name = $name;
$this->connections = $connections;
$this->managers = $managers;
$this->defaultConnection = $defaultConnection;
$this->defaultManager = $defaultManager;
$this->proxyInterfaceName = $proxyInterfaceName;
}
abstract protected function getService($name);
abstract protected function resetService($name);
public function getName()
{
return $this->name;
}
public function getConnection($name = null)
{
if (null === $name) {
$name = $this->defaultConnection;
}
if (!isset($this->connections[$name])) {
throw new \InvalidArgumentException(sprintf('Doctrine %s Connection named "%s" does not exist.', $this->name, $name));
}
return $this->getService($this->connections[$name]);
}
public function getConnectionNames()
{
return $this->connections;
}
public function getConnections()
{
$connections = [];
foreach ($this->connections as $name => $id) {
$connections[$name] = $this->getService($id);
}
return $connections;
}
public function getDefaultConnectionName()
{
return $this->defaultConnection;
}
public function getDefaultManagerName()
{
return $this->defaultManager;
}
public function getManager($name = null)
{
if (null === $name) {
$name = $this->defaultManager;
}
if (!isset($this->managers[$name])) {
throw new \InvalidArgumentException(sprintf('Doctrine %s Manager named "%s" does not exist.', $this->name, $name));
}
return $this->getService($this->managers[$name]);
}
public function getManagerForClass($class)
{
if (strpos($class,':') !== false) {
list($namespaceAlias, $simpleClassName) = explode(':', $class, 2);
$class = $this->getAliasNamespace($namespaceAlias) .'\\'. $simpleClassName;
}
$proxyClass = new \ReflectionClass($class);
if ($proxyClass->implementsInterface($this->proxyInterfaceName)) {
if (! $parentClass = $proxyClass->getParentClass()) {
return null;
}
$class = $parentClass->getName();
}
foreach ($this->managers as $id) {
$manager = $this->getService($id);
if (!$manager->getMetadataFactory()->isTransient($class)) {
return $manager;
}
}
}
public function getManagerNames()
{
return $this->managers;
}
public function getManagers()
{
$dms = [];
foreach ($this->managers as $name => $id) {
$dms[$name] = $this->getService($id);
}
return $dms;
}
public function getRepository($persistentObjectName, $persistentManagerName = null)
{
return $this->getManager($persistentManagerName)->getRepository($persistentObjectName);
}
public function resetManager($name = null)
{
if (null === $name) {
$name = $this->defaultManager;
}
if (!isset($this->managers[$name])) {
throw new \InvalidArgumentException(sprintf('Doctrine %s Manager named "%s" does not exist.', $this->name, $name));
}
$this->resetService($this->managers[$name]);
}
}
}
namespace Symfony\Bridge\Doctrine
{
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\AbstractManagerRegistry;
abstract class ManagerRegistry extends AbstractManagerRegistry implements ContainerAwareInterface
{
protected $container;
protected function getService($name)
{
return $this->container->get($name);
}
protected function resetService($name)
{
$this->container->set($name, null);
}
public function setContainer(ContainerInterface $container = null)
{
$this->container = $container;
}
}
}
namespace Doctrine\Bundle\DoctrineBundle
{
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\EntityManager;
class Registry extends ManagerRegistry implements RegistryInterface
{
public function __construct(ContainerInterface $container, array $connections, array $entityManagers, $defaultConnection, $defaultEntityManager)
{
$this->setContainer($container);
parent::__construct('ORM', $connections, $entityManagers, $defaultConnection, $defaultEntityManager,'Doctrine\ORM\Proxy\Proxy');
}
public function getDefaultEntityManagerName()
{
trigger_error('getDefaultEntityManagerName is deprecated since Symfony 2.1. Use getDefaultManagerName instead', E_USER_DEPRECATED);
return $this->getDefaultManagerName();
}
public function getEntityManager($name = null)
{
trigger_error('getEntityManager is deprecated since Symfony 2.1. Use getManager instead', E_USER_DEPRECATED);
return $this->getManager($name);
}
public function getEntityManagers()
{
trigger_error('getEntityManagers is deprecated since Symfony 2.1. Use getManagers instead', E_USER_DEPRECATED);
return $this->getManagers();
}
public function resetEntityManager($name = null)
{
trigger_error('resetEntityManager is deprecated since Symfony 2.1. Use resetManager instead', E_USER_DEPRECATED);
$this->resetManager($name);
}
public function getEntityNamespace($alias)
{
trigger_error('getEntityNamespace is deprecated since Symfony 2.1. Use getAliasNamespace instead', E_USER_DEPRECATED);
return $this->getAliasNamespace($alias);
}
public function getAliasNamespace($alias)
{
foreach (array_keys($this->getManagers()) as $name) {
try {
return $this->getManager($name)->getConfiguration()->getEntityNamespace($alias);
} catch (ORMException $e) {
}
}
throw ORMException::unknownEntityNamespace($alias);
}
public function getEntityManagerNames()
{
trigger_error('getEntityManagerNames is deprecated since Symfony 2.1. Use getManagerNames instead', E_USER_DEPRECATED);
return $this->getManagerNames();
}
public function getEntityManagerForClass($class)
{
trigger_error('getEntityManagerForClass is deprecated since Symfony 2.1. Use getManagerForClass instead', E_USER_DEPRECATED);
return $this->getManagerForClass($class);
}
}
}
namespace Sensio\Bundle\FrameworkExtraBundle\EventListener
{
use Doctrine\Common\Annotations\Reader;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ConfigurationInterface;
use Doctrine\Common\Util\ClassUtils;
class ControllerListener implements EventSubscriberInterface
{
protected $reader;
public function __construct(Reader $reader)
{
$this->reader = $reader;
}
public function onKernelController(FilterControllerEvent $event)
{
if (!is_array($controller = $event->getController())) {
return;
}
$className = class_exists('Doctrine\Common\Util\ClassUtils') ? ClassUtils::getClass($controller[0]) : get_class($controller[0]);
$object = new \ReflectionClass($className);
$method = $object->getMethod($controller[1]);
$classConfigurations = $this->getConfigurations($this->reader->getClassAnnotations($object));
$methodConfigurations = $this->getConfigurations($this->reader->getMethodAnnotations($method));
$configurations = array();
foreach (array_merge(array_keys($classConfigurations), array_keys($methodConfigurations)) as $key) {
if (!array_key_exists($key, $classConfigurations)) {
$configurations[$key] = $methodConfigurations[$key];
} elseif (!array_key_exists($key, $methodConfigurations)) {
$configurations[$key] = $classConfigurations[$key];
} else {
if (is_array($classConfigurations[$key])) {
if (!is_array($methodConfigurations[$key])) {
throw new \UnexpectedValueException('Configurations should both be an array or both not be an array');
}
$configurations[$key] = array_merge($classConfigurations[$key], $methodConfigurations[$key]);
} else {
$configurations[$key] = $methodConfigurations[$key];
}
}
}
$request = $event->getRequest();
foreach ($configurations as $key => $attributes) {
$request->attributes->set($key, $attributes);
}
}
protected function getConfigurations(array $annotations)
{
$configurations = array();
foreach ($annotations as $configuration) {
if ($configuration instanceof ConfigurationInterface) {
if ($configuration->allowArray()) {
$configurations['_'.$configuration->getAliasName()][] = $configuration;
} elseif (!isset($configurations['_'.$configuration->getAliasName()])) {
$configurations['_'.$configuration->getAliasName()] = $configuration;
} else {
throw new \LogicException(sprintf('Multiple "%s" annotations are not allowed.', $configuration->getAliasName()));
}
}
}
return $configurations;
}
public static function getSubscribedEvents()
{
return array(
KernelEvents::CONTROLLER =>'onKernelController',
);
}
}
}
namespace Sensio\Bundle\FrameworkExtraBundle\EventListener
{
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
class ParamConverterListener implements EventSubscriberInterface
{
protected $manager;
protected $autoConvert;
public function __construct(ParamConverterManager $manager, $autoConvert = true)
{
$this->manager = $manager;
$this->autoConvert = $autoConvert;
}
public function onKernelController(FilterControllerEvent $event)
{
$controller = $event->getController();
$request = $event->getRequest();
$configurations = array();
if ($configuration = $request->attributes->get('_converters')) {
foreach (is_array($configuration) ? $configuration : array($configuration) as $configuration) {
$configurations[$configuration->getName()] = $configuration;
}
}
if (is_array($controller)) {
$r = new \ReflectionMethod($controller[0], $controller[1]);
} elseif (is_object($controller) && is_callable($controller,'__invoke')) {
$r = new \ReflectionMethod($controller,'__invoke');
} else {
$r = new \ReflectionFunction($controller);
}
if ($this->autoConvert) {
$configurations = $this->autoConfigure($r, $request, $configurations);
}
$this->manager->apply($request, $configurations);
}
private function autoConfigure(\ReflectionFunctionAbstract $r, Request $request, $configurations)
{
foreach ($r->getParameters() as $param) {
if (!$param->getClass() || $param->getClass()->isInstance($request)) {
continue;
}
$name = $param->getName();
if (!isset($configurations[$name])) {
$configuration = new ParamConverter(array());
$configuration->setName($name);
$configuration->setClass($param->getClass()->getName());
$configurations[$name] = $configuration;
} elseif (null === $configurations[$name]->getClass()) {
$configurations[$name]->setClass($param->getClass()->getName());
}
$configurations[$name]->setIsOptional($param->isOptional());
}
return $configurations;
}
public static function getSubscribedEvents()
{
return array(
KernelEvents::CONTROLLER =>'onKernelController',
);
}
}
}
namespace Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter
{
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
interface ParamConverterInterface
{
public function apply(Request $request, ParamConverter $configuration);
public function supports(ParamConverter $configuration);
}
}
namespace Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter
{
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use DateTime;
class DateTimeParamConverter implements ParamConverterInterface
{
public function apply(Request $request, ParamConverter $configuration)
{
$param = $configuration->getName();
if (!$request->attributes->has($param)) {
return false;
}
$options = $configuration->getOptions();
$value = $request->attributes->get($param);
if (!$value && $configuration->isOptional()) {
return false;
}
if (isset($options['format'])) {
$date = DateTime::createFromFormat($options['format'], $value);
if (!$date) {
throw new NotFoundHttpException('Invalid date given.');
}
} else {
if (false === strtotime($value)) {
throw new NotFoundHttpException('Invalid date given.');
}
$date = new DateTime($value);
}
$request->attributes->set($param, $date);
return true;
}
public function supports(ParamConverter $configuration)
{
if (null === $configuration->getClass()) {
return false;
}
return'DateTime'=== $configuration->getClass();
}
}
}
namespace Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter
{
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NoResultException;
class DoctrineParamConverter implements ParamConverterInterface
{
protected $registry;
public function __construct(ManagerRegistry $registry = null)
{
$this->registry = $registry;
}
public function apply(Request $request, ParamConverter $configuration)
{
$name = $configuration->getName();
$class = $configuration->getClass();
$options = $this->getOptions($configuration);
if (null === $request->attributes->get($name, false)) {
$configuration->setIsOptional(true);
}
if (false === $object = $this->find($class, $request, $options, $name)) {
if (false === $object = $this->findOneBy($class, $request, $options)) {
if ($configuration->isOptional()) {
$object = null;
} else {
throw new \LogicException('Unable to guess how to get a Doctrine instance from the request information.');
}
}
}
if (null === $object && false === $configuration->isOptional()) {
throw new NotFoundHttpException(sprintf('%s object not found.', $class));
}
$request->attributes->set($name, $object);
return true;
}
protected function find($class, Request $request, $options, $name)
{
if ($options['mapping'] || $options['exclude']) {
return false;
}
$id = $this->getIdentifier($request, $options, $name);
if (false === $id || null === $id) {
return false;
}
if (isset($options['repository_method'])) {
$method = $options['repository_method'];
} else {
$method ='find';
}
try {
return $this->getManager($options['entity_manager'], $class)->getRepository($class)->$method($id);
} catch (NoResultException $e) {
return;
}
}
protected function getIdentifier(Request $request, $options, $name)
{
if (isset($options['id'])) {
if (!is_array($options['id'])) {
$name = $options['id'];
} elseif (is_array($options['id'])) {
$id = array();
foreach ($options['id'] as $field) {
$id[$field] = $request->attributes->get($field);
}
return $id;
}
}
if ($request->attributes->has($name)) {
return $request->attributes->get($name);
}
if ($request->attributes->has('id') && !isset($options['id'])) {
return $request->attributes->get('id');
}
return false;
}
protected function findOneBy($class, Request $request, $options)
{
if (!$options['mapping']) {
$keys = $request->attributes->keys();
$options['mapping'] = $keys ? array_combine($keys, $keys) : array();
}
foreach ($options['exclude'] as $exclude) {
unset($options['mapping'][$exclude]);
}
if (!$options['mapping']) {
return false;
}
if (isset($options['id']) && null === $request->attributes->get($options['id'])) {
return false;
}
$criteria = array();
$em = $this->getManager($options['entity_manager'], $class);
$metadata = $em->getClassMetadata($class);
$mapMethodSignature = isset($options['repository_method'])
&& isset($options['map_method_signature'])
&& $options['map_method_signature'] === true;
foreach ($options['mapping'] as $attribute => $field) {
if ($metadata->hasField($field)
|| ($metadata->hasAssociation($field) && $metadata->isSingleValuedAssociation($field))
|| $mapMethodSignature) {
$criteria[$field] = $request->attributes->get($attribute);
}
}
if ($options['strip_null']) {
$criteria = array_filter($criteria, function ($value) { return !is_null($value); });
}
if (!$criteria) {
return false;
}
if (isset($options['repository_method'])) {
$repositoryMethod = $options['repository_method'];
} else {
$repositoryMethod ='findOneBy';
}
try {
if ($mapMethodSignature) {
return $this->findDataByMapMethodSignature($em, $class, $repositoryMethod, $criteria);
}
return $em->getRepository($class)->$repositoryMethod($criteria);
} catch (NoResultException $e) {
return;
}
}
private function findDataByMapMethodSignature($em, $class, $repositoryMethod, $criteria)
{
$arguments = array();
$repository = $em->getRepository($class);
$ref = new \ReflectionMethod($repository, $repositoryMethod);
foreach ($ref->getParameters() as $parameter) {
if (array_key_exists($parameter->name, $criteria)) {
$arguments[] = $criteria[$parameter->name];
} elseif ($parameter->isDefaultValueAvailable()) {
$arguments[] = $parameter->getDefaultValue();
} else {
throw new \InvalidArgumentException(sprintf('Repository method "%s::%s" requires that you provide a value for the "$%s" argument.', get_class($repository), $repositoryMethod, $parameter->name));
}
}
return $ref->invokeArgs($repository, $arguments);
}
public function supports(ParamConverter $configuration)
{
if (null === $this->registry || !count($this->registry->getManagers())) {
return false;
}
if (null === $configuration->getClass()) {
return false;
}
$options = $this->getOptions($configuration);
$em = $this->getManager($options['entity_manager'], $configuration->getClass());
if (null === $em) {
return false;
}
return !$em->getMetadataFactory()->isTransient($configuration->getClass());
}
protected function getOptions(ParamConverter $configuration)
{
return array_replace(array('entity_manager'=> null,'exclude'=> array(),'mapping'=> array(),'strip_null'=> false,
), $configuration->getOptions());
}
private function getManager($name, $class)
{
if (null === $name) {
return $this->registry->getManagerForClass($class);
}
return $this->registry->getManager($name);
}
}
}
namespace Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter
{
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ConfigurationInterface;
class ParamConverterManager
{
protected $converters = array();
protected $namedConverters = array();
public function apply(Request $request, $configurations)
{
if (is_object($configurations)) {
$configurations = array($configurations);
}
foreach ($configurations as $configuration) {
$this->applyConverter($request, $configuration);
}
}
protected function applyConverter(Request $request, ConfigurationInterface $configuration)
{
$value = $request->attributes->get($configuration->getName());
$className = $configuration->getClass();
if (is_object($value) && $value instanceof $className) {
return;
}
if ($converterName = $configuration->getConverter()) {
if (!isset($this->namedConverters[$converterName])) {
throw new \RuntimeException(sprintf("No converter named '%s' found for conversion of parameter '%s'.",
$converterName, $configuration->getName()
));
}
$converter = $this->namedConverters[$converterName];
if (!$converter->supports($configuration)) {
throw new \RuntimeException(sprintf("Converter '%s' does not support conversion of parameter '%s'.",
$converterName, $configuration->getName()
));
}
$converter->apply($request, $configuration);
return;
}
foreach ($this->all() as $converter) {
if ($converter->supports($configuration)) {
if ($converter->apply($request, $configuration)) {
return;
}
}
}
}
public function add(ParamConverterInterface $converter, $priority = 0, $name = null)
{
if ($priority !== null) {
if (!isset($this->converters[$priority])) {
$this->converters[$priority] = array();
}
$this->converters[$priority][] = $converter;
}
if (null !== $name) {
$this->namedConverters[$name] = $converter;
}
}
public function all()
{
krsort($this->converters);
$converters = array();
foreach ($this->converters as $all) {
$converters = array_merge($converters, $all);
}
return $converters;
}
}
}
namespace Sensio\Bundle\FrameworkExtraBundle\EventListener
{
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
class TemplateListener implements EventSubscriberInterface
{
protected $container;
public function __construct(ContainerInterface $container)
{
$this->container = $container;
}
public function onKernelController(FilterControllerEvent $event)
{
$request = $event->getRequest();
$template = $request->attributes->get('_template');
if (null === $template) {
return;
}
if (!$template instanceof Template) {
throw new \InvalidArgumentException('Request attribute "_template" is reserved for @Template annotations.');
}
$template->setOwner($controller = $event->getController());
if (null === $template->getTemplate()) {
$guesser = $this->container->get('sensio_framework_extra.view.guesser');
$template->setTemplate($guesser->guessTemplateName($controller, $request, $template->getEngine()));
}
}
public function onKernelView(GetResponseForControllerResultEvent $event)
{
$request = $event->getRequest();
$template = $request->attributes->get('_template');
if (null === $template) {
return;
}
$parameters = $event->getControllerResult();
$owner = $template->getOwner();
list($controller, $action) = $owner;
if (null === $parameters) {
$parameters = $this->resolveDefaultParameters($request, $template, $controller, $action);
}
$templating = $this->container->get('templating');
if ($template->isStreamable()) {
$callback = function () use ($templating, $template, $parameters) {
return $templating->stream($template->getTemplate(), $parameters);
};
$event->setResponse(new StreamedResponse($callback));
}
$template->setOwner(array());
$event->setResponse($templating->renderResponse($template->getTemplate(), $parameters));
}
public static function getSubscribedEvents()
{
return array(
KernelEvents::CONTROLLER => array('onKernelController', -128),
KernelEvents::VIEW =>'onKernelView',
);
}
private function resolveDefaultParameters(Request $request, Template $template, $controller, $action)
{
$parameters = array();
$arguments = $template->getVars();
if (0 === count($arguments)) {
$r = new \ReflectionObject($controller);
$arguments = array();
foreach ($r->getMethod($action)->getParameters() as $param) {
$arguments[] = $param->getName();
}
}
foreach ($arguments as $argument) {
$parameters[$argument] = $request->attributes->get($argument);
}
return $parameters;
}
}
}
namespace Sensio\Bundle\FrameworkExtraBundle\EventListener
{
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
class HttpCacheListener implements EventSubscriberInterface
{
private $lastModifiedDates;
private $etags;
private $expressionLanguage;
public function __construct()
{
$this->lastModifiedDates = new \SplObjectStorage();
$this->etags = new \SplObjectStorage();
}
public function onKernelController(FilterControllerEvent $event)
{
$request = $event->getRequest();
if (!$configuration = $request->attributes->get('_cache')) {
return;
}
$response = new Response();
$lastModifiedDate ='';
if ($configuration->getLastModified()) {
$lastModifiedDate = $this->getExpressionLanguage()->evaluate($configuration->getLastModified(), $request->attributes->all());
$response->setLastModified($lastModifiedDate);
}
$etag ='';
if ($configuration->getETag()) {
$etag = hash('sha256', $this->getExpressionLanguage()->evaluate($configuration->getETag(), $request->attributes->all()));
$response->setETag($etag);
}
if ($response->isNotModified($request)) {
$event->setController(function () use ($response) {
return $response;
});
} else {
if ($etag) {
$this->etags[$request] = $etag;
}
if ($lastModifiedDate) {
$this->lastModifiedDates[$request] = $lastModifiedDate;
}
}
}
public function onKernelResponse(FilterResponseEvent $event)
{
$request = $event->getRequest();
if (!$configuration = $request->attributes->get('_cache')) {
return;
}
$response = $event->getResponse();
if (!in_array($response->getStatusCode(), array(200, 203, 300, 301, 302, 304, 404, 410))) {
return;
}
if (null !== $age = $configuration->getSMaxAge()) {
if (!is_numeric($age)) {
$now = microtime(true);
$age = ceil(strtotime($configuration->getSMaxAge(), $now) - $now);
}
$response->setSharedMaxAge($age);
}
if (null !== $age = $configuration->getMaxAge()) {
if (!is_numeric($age)) {
$now = microtime(true);
$age = ceil(strtotime($configuration->getMaxAge(), $now) - $now);
}
$response->setMaxAge($age);
}
if (null !== $configuration->getExpires()) {
$date = \DateTime::createFromFormat('U', strtotime($configuration->getExpires()), new \DateTimeZone('UTC'));
$response->setExpires($date);
}
if (null !== $configuration->getVary()) {
$response->setVary($configuration->getVary());
}
if ($configuration->isPublic()) {
$response->setPublic();
}
if ($configuration->isPrivate()) {
$response->setPrivate();
}
if (isset($this->lastModifiedDates[$request])) {
$response->setLastModified($this->lastModifiedDates[$request]);
unset($this->lastModifiedDates[$request]);
}
if (isset($this->etags[$request])) {
$response->setETag($this->etags[$request]);
unset($this->etags[$request]);
}
$event->setResponse($response);
}
public static function getSubscribedEvents()
{
return array(
KernelEvents::CONTROLLER =>'onKernelController',
KernelEvents::RESPONSE =>'onKernelResponse',
);
}
private function getExpressionLanguage()
{
if (null === $this->expressionLanguage) {
if (!class_exists('Symfony\Component\ExpressionLanguage\ExpressionLanguage')) {
throw new \RuntimeException('Unable to use expressions as the Symfony ExpressionLanguage component is not installed.');
}
$this->expressionLanguage = new ExpressionLanguage();
}
return $this->expressionLanguage;
}
}
}
namespace Sensio\Bundle\FrameworkExtraBundle\EventListener
{
use Sensio\Bundle\FrameworkExtraBundle\Security\ExpressionLanguage;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\AuthenticationTrustResolverInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Role\RoleHierarchyInterface;
class SecurityListener implements EventSubscriberInterface
{
private $tokenStorage;
private $authChecker;
private $language;
private $trustResolver;
private $roleHierarchy;
public function __construct(SecurityContextInterface $securityContext = null, ExpressionLanguage $language = null, AuthenticationTrustResolverInterface $trustResolver = null, RoleHierarchyInterface $roleHierarchy = null, TokenStorageInterface $tokenStorage = null, AuthorizationCheckerInterface $authChecker = null)
{
$this->tokenStorage = $tokenStorage ?: $securityContext;
$this->authChecker = $authChecker ?: $securityContext;
$this->language = $language;
$this->trustResolver = $trustResolver;
$this->roleHierarchy = $roleHierarchy;
}
public function onKernelController(FilterControllerEvent $event)
{
$request = $event->getRequest();
if (!$configuration = $request->attributes->get('_security')) {
return;
}
if (null === $this->tokenStorage || null === $this->trustResolver) {
throw new \LogicException('To use the @Security tag, you need to install the Symfony Security bundle.');
}
if (null === $this->tokenStorage->getToken()) {
throw new \LogicException('To use the @Security tag, your controller needs to be behind a firewall.');
}
if (null === $this->language) {
throw new \LogicException('To use the @Security tag, you need to use the Security component 2.4 or newer and to install the ExpressionLanguage component.');
}
if (!$this->language->evaluate($configuration->getExpression(), $this->getVariables($request))) {
throw new AccessDeniedException(sprintf('Expression "%s" denied access.', $configuration->getExpression()));
}
}
private function getVariables(Request $request)
{
$token = $this->tokenStorage->getToken();
if (null !== $this->roleHierarchy) {
$roles = $this->roleHierarchy->getReachableRoles($token->getRoles());
} else {
$roles = $token->getRoles();
}
$variables = array('token'=> $token,'user'=> $token->getUser(),'object'=> $request,'request'=> $request,'roles'=> array_map(function ($role) { return $role->getRole(); }, $roles),'trust_resolver'=> $this->trustResolver,'auth_checker'=> $this->authChecker,
);
return array_merge($request->attributes->all(), $variables);
}
public static function getSubscribedEvents()
{
return array(KernelEvents::CONTROLLER =>'onKernelController');
}
}
}
namespace Sensio\Bundle\FrameworkExtraBundle\Configuration
{
interface ConfigurationInterface
{
public function getAliasName();
public function allowArray();
}
}
namespace Sensio\Bundle\FrameworkExtraBundle\Configuration
{
abstract class ConfigurationAnnotation implements ConfigurationInterface
{
public function __construct(array $values)
{
foreach ($values as $k => $v) {
if (!method_exists($this, $name ='set'.$k)) {
throw new \RuntimeException(sprintf('Unknown key "%s" for annotation "@%s".', $k, get_class($this)));
}
$this->$name($v);
}
}
}
}
namespace JMS\DiExtraBundle\HttpKernel
{
use CG\Proxy\Enhancer;
use JMS\AopBundle\DependencyInjection\Compiler\PointcutMatchingPass;
use JMS\DiExtraBundle\Generator\DefinitionInjectorGenerator;
use JMS\DiExtraBundle\Generator\LookupMethodClassGenerator;
use JMS\DiExtraBundle\Metadata\ClassMetadata;
use Metadata\ClassHierarchyMetadata;
use Symfony\Bundle\FrameworkBundle\Controller\ControllerResolver as BaseControllerResolver;
use Symfony\Component\Config\ConfigCache;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\Compiler\InlineServiceDefinitionsPass;
use Symfony\Component\DependencyInjection\Compiler\ResolveDefinitionTemplatesPass;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
class ControllerResolver extends BaseControllerResolver
{
protected function createController($controller)
{
if (false === strpos($controller,'::')) {
$count = substr_count($controller,':');
if (2 == $count) {
$controller = $this->parser->parse($controller);
} elseif (1 == $count) {
list($service, $method) = explode(':', $controller, 2);
return array($this->container->get($service), $method);
} elseif ($this->container->has($controller) && method_exists($service = $this->container->get($controller),'__invoke')) {
return $service;
} else {
throw new \LogicException(sprintf('Unable to parse the controller name "%s".', $controller));
}
}
list($class, $method) = explode('::', $controller, 2);
if (!class_exists($class)) {
throw new \InvalidArgumentException(sprintf('Class "%s" does not exist.', $class));
}
return array($this->instantiateController($class), $method);
}
protected function instantiateController($class)
{
if ($this->container->has($class)) {
return $this->container->get($class);
}
$injector = $this->createInjector($class);
$controller = call_user_func($injector, $this->container);
if ($controller instanceof ContainerAwareInterface) {
$controller->setContainer($this->container);
}
return $controller;
}
public function createInjector($class)
{
$filename = $this->container->getParameter('jms_di_extra.cache_dir').'/controller_injectors/'.str_replace('\\','', $class).'.php';
$cache = new ConfigCache($filename, $this->container->getParameter('kernel.debug'));
if (!$cache->isFresh()) {
$metadata = $this->container->get('jms_di_extra.metadata.metadata_factory')->getMetadataForClass($class);
if (null === $metadata) {
$metadata = new ClassHierarchyMetadata();
$metadata->addClassMetadata(new ClassMetadata($class));
}
if (null !== $metadata->getOutsideClassMetadata()->id
&& 0 !== strpos($metadata->getOutsideClassMetadata()->id,'_jms_di_extra.unnamed.service')) {
return;
}
$this->prepareContainer($cache, $filename, $metadata, $class, $filename);
}
if ( ! class_exists($class.'__JMSInjector', false)) {
require $filename;
}
return array($class.'__JMSInjector','inject');
}
private function prepareContainer($cache, $containerFilename, $metadata, $className, $targetPath)
{
$container = new ContainerBuilder();
$container->setParameter('jms_aop.cache_dir', $this->container->getParameter('jms_di_extra.cache_dir'));
$def = $container
->register('jms_aop.interceptor_loader','JMS\AopBundle\Aop\InterceptorLoader')
->addArgument(new Reference('service_container'))
->setPublic(false)
;
$ref = $metadata->getOutsideClassMetadata()->reflection;
while ($ref && false !== $filename = $ref->getFilename()) {
$container->addResource(new FileResource($filename));
$ref = $ref->getParentClass();
}
$definitions = $this->container->get('jms_di_extra.metadata.converter')->convert($metadata);
$serviceIds = $parameters = array();
$controllerDef = array_pop($definitions);
$container->setDefinition('controller', $controllerDef);
foreach ($definitions as $id => $def) {
$container->setDefinition($id, $def);
}
$this->generateLookupMethods($controllerDef, $metadata);
$config = $container->getCompilerPassConfig();
$config->setOptimizationPasses(array());
$config->setRemovingPasses(array());
$config->addPass(new ResolveDefinitionTemplatesPass());
$config->addPass(new PointcutMatchingPass($this->container->get('jms_aop.pointcut_container')->getPointcuts()));
$config->addPass(new InlineServiceDefinitionsPass());
$container->compile();
if (!file_exists($dir = dirname($containerFilename))) {
if (false === @mkdir($dir, 0777, true)) {
throw new \RuntimeException(sprintf('Could not create directory "%s".', $dir));
}
}
static $generator;
if (null === $generator) {
$generator = new DefinitionInjectorGenerator();
}
$cache->write($generator->generate($container->getDefinition('controller'), $className, $targetPath), $container->getResources());
}
private function generateLookupMethods($def, $metadata)
{
$found = false;
foreach ($metadata->classMetadata as $cMetadata) {
if (!empty($cMetadata->lookupMethods)) {
$found = true;
break;
}
}
if (!$found) {
return;
}
$generator = new LookupMethodClassGenerator($metadata);
$outerClass = $metadata->getOutsideClassMetadata()->reflection;
if ($file = $def->getFile()) {
$generator->setRequiredFile($file);
}
$enhancer = new Enhancer(
$outerClass,
array(),
array(
$generator,
)
);
$filename = $this->container->getParameter('jms_di_extra.cache_dir').'/lookup_method_classes/'.str_replace('\\','-', $outerClass->name).'.php';
$enhancer->writeClass($filename);
$def->setFile($filename);
$def->setClass($enhancer->getClassName($outerClass));
$def->addMethodCall('__jmsDiExtra_setContainer', array(new Reference('service_container')));
}
}
}
namespace Symfony\Component\Form
{
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
interface FormTypeInterface
{
public function buildForm(FormBuilderInterface $builder, array $options);
public function buildView(FormView $view, FormInterface $form, array $options);
public function finishView(FormView $view, FormInterface $form, array $options);
public function setDefaultOptions(OptionsResolverInterface $resolver);
public function getParent();
public function getName();
}
}
namespace Symfony\Component\Form
{
use Symfony\Component\Form\Util\StringUtil;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
abstract class AbstractType implements FormTypeInterface
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
}
public function buildView(FormView $view, FormInterface $form, array $options)
{
}
public function finishView(FormView $view, FormInterface $form, array $options)
{
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
if (!$resolver instanceof OptionsResolver) {
throw new \InvalidArgumentException(sprintf('Custom resolver "%s" must extend "Symfony\Component\OptionsResolver\OptionsResolver".', get_class($resolver)));
}
$this->configureOptions($resolver);
}
public function configureOptions(OptionsResolver $resolver)
{
}
public function getName()
{
return get_class($this);
}
public function getBlockPrefix()
{
$fqcn = get_class($this);
$name = $this->getName();
return $name !== $fqcn ? $name : StringUtil::fqcnToBlockPrefix($fqcn);
}
public function getParent()
{
return'Symfony\Component\Form\Extension\Core\Type\FormType';
}
}
}
namespace Sonata\CoreBundle\Form\Type
{
use Sonata\CoreBundle\Form\DataTransformer\BooleanTypeToBooleanTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class BooleanType extends AbstractType
{
const TYPE_YES = 1;
const TYPE_NO = 2;
public function buildForm(FormBuilderInterface $builder, array $options)
{
if ($options['transform']) {
$builder->addModelTransformer(new BooleanTypeToBooleanTransformer());
}
if ($options['catalogue'] !=='SonataCoreBundle') {
@trigger_error('Option "catalogue" is deprecated since SonataCoreBundle 2.3.10 and will be removed in 3.0. Use option "translation_domain" instead.', E_USER_DEPRECATED);
}
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$this->configureOptions($resolver);
}
public function configureOptions(OptionsResolver $resolver)
{
$choices = array(
self::TYPE_YES =>'label_type_yes',
self::TYPE_NO =>'label_type_no',
);
$defaultOptions = array('transform'=> false,'catalogue'=>'SonataCoreBundle','translation_domain'=> function (Options $options) {
if ($options['catalogue']) {
return $options['catalogue'];
}
return $options['translation_domain'];
},
);
if (method_exists('Symfony\Component\Form\AbstractType','configureOptions')) {
$choices = array_flip($choices);
if (method_exists('Symfony\Component\Form\FormTypeInterface','setDefaultOptions')) {
$defaultOptions['choices_as_value'] = true;
}
}
$defaultOptions['choices'] = $choices;
$resolver->setDefaults($defaultOptions);
}
public function getParent()
{
return method_exists('Symfony\Component\Form\AbstractType','getBlockPrefix') ?'Symfony\Component\Form\Extension\Core\Type\ChoiceType':'choice';
}
public function getName()
{
return $this->getBlockPrefix();
}
public function getBlockPrefix()
{
return'sonata_type_boolean';
}
}
}
namespace Sonata\CoreBundle\Form\Type
{
use Sonata\CoreBundle\Form\EventListener\ResizeFormListener;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class CollectionType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
$listener = new ResizeFormListener(
$options['type'],
$options['type_options'],
$options['modifiable'],
$options['pre_bind_data_callback']
);
$builder->addEventSubscriber($listener);
}
public function buildView(FormView $view, FormInterface $form, array $options)
{
$view->vars['btn_add'] = $options['btn_add'];
$view->vars['btn_catalogue'] = $options['btn_catalogue'];
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$this->configureOptions($resolver);
}
public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults(array('modifiable'=> false,'type'=>'text','type_options'=> array(),'pre_bind_data_callback'=> null,'btn_add'=>'link_add','btn_catalogue'=>'SonataCoreBundle',
));
}
public function getBlockPrefix()
{
return'sonata_type_collection';
}
public function getName()
{
return $this->getBlockPrefix();
}
}
}
namespace Sonata\CoreBundle\Form\Type
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Translation\TranslatorInterface;
class DateRangeType extends AbstractType
{
protected $translator;
public function __construct(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function buildForm(FormBuilderInterface $builder, array $options)
{
$options['field_options_start'] = array_merge(
array('label'=> $this->translator->trans('date_range_start', array(),'SonataCoreBundle'),
),
$options['field_options_start']
);
$options['field_options_end'] = array_merge(
array('label'=> $this->translator->trans('date_range_end', array(),'SonataCoreBundle'),
),
$options['field_options_end']
);
$builder->add('start', $options['field_type'], array_merge(array('required'=> false), $options['field_options'], $options['field_options_start']));
$builder->add('end', $options['field_type'], array_merge(array('required'=> false), $options['field_options'], $options['field_options_end']));
}
public function getBlockPrefix()
{
return'sonata_type_date_range';
}
public function getName()
{
return $this->getBlockPrefix();
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$this->configureOptions($resolver);
}
public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults(array('field_options'=> array(),'field_options_start'=> array(),'field_options_end'=> array(),'field_type'=>'date',
));
}
}
}
namespace Sonata\CoreBundle\Form\Type
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Translation\TranslatorInterface;
class DateTimeRangeType extends AbstractType
{
protected $translator;
public function __construct(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function buildForm(FormBuilderInterface $builder, array $options)
{
$options['field_options_start'] = array_merge(
array('label'=> $this->translator->trans('date_range_start', array(),'SonataCoreBundle'),
),
$options['field_options_start']
);
$options['field_options_end'] = array_merge(
array('label'=> $this->translator->trans('date_range_end', array(),'SonataCoreBundle'),
),
$options['field_options_end']
);
$builder->add('start', $options['field_type'], array_merge(array('required'=> false), $options['field_options'], $options['field_options_start']));
$builder->add('end', $options['field_type'], array_merge(array('required'=> false), $options['field_options'], $options['field_options_end']));
}
public function getBlockPrefix()
{
return'sonata_type_datetime_range';
}
public function getName()
{
return $this->getBlockPrefix();
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$this->configureOptions($resolver);
}
public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults(array('field_options'=> array(),'field_options_start'=> array(),'field_options_end'=> array(),'field_type'=>'datetime',
));
}
}
}
namespace Sonata\CoreBundle\Form\Type
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Translation\TranslatorInterface;
class EqualType extends AbstractType
{
const TYPE_IS_EQUAL = 1;
const TYPE_IS_NOT_EQUAL = 2;
protected $translator;
public function __construct(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$this->configureOptions($resolver);
}
public function configureOptions(OptionsResolver $resolver)
{
$choices = array(
self::TYPE_IS_EQUAL => $this->translator->trans('label_type_equals', array(),'SonataCoreBundle'),
self::TYPE_IS_NOT_EQUAL => $this->translator->trans('label_type_not_equals', array(),'SonataCoreBundle'),
);
$defaultOptions = array();
if (method_exists('Symfony\Component\Form\AbstractType','configureOptions')) {
$choices = array_flip($choices);
if (method_exists('Symfony\Component\Form\FormTypeInterface','setDefaultOptions')) {
$defaultOptions['choices_as_value'] = true;
}
}
$defaultOptions['choices'] = $choices;
$resolver->setDefaults($defaultOptions);
}
public function getParent()
{
return method_exists('Symfony\Component\Form\AbstractType','getBlockPrefix') ?'Symfony\Component\Form\Extension\Core\Type\ChoiceType':'choice';
}
public function getBlockPrefix()
{
return'sonata_type_equal';
}
public function getName()
{
return $this->getBlockPrefix();
}
}
}
namespace Sonata\CoreBundle\Form\Type
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class ImmutableArrayType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
foreach ($options['keys'] as $infos) {
if ($infos instanceof FormBuilderInterface) {
$builder->add($infos);
} else {
list($name, $type, $options) = $infos;
if (is_callable($options)) {
$extra = array_slice($infos, 3);
$options = $options($builder, $name, $type, $extra);
if ($options === null) {
$options = array();
} elseif (!is_array($options)) {
throw new \RuntimeException('the closure must return null or an array');
}
}
$builder->add($name, $type, $options);
}
}
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$this->configureOptions($resolver);
}
public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults(array('keys'=> array(),
));
}
public function getBlockPrefix()
{
return'sonata_type_immutable_array';
}
public function getName()
{
return $this->getBlockPrefix();
}
}
}
namespace Sonata\CoreBundle\Form\Type
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Translation\TranslatorInterface;
class TranslatableChoiceType extends AbstractType
{
protected $translator;
public function __construct(TranslatorInterface $translator)
{
@trigger_error('Form type "sonata_type_translatable_choice" is deprecated since SonataCoreBundle 2.2.0 and will be removed in 3.0. Use form type "choice" with "translation_domain" option instead.', E_USER_DEPRECATED);
$this->translator = $translator;
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$this->configureOptions($resolver);
}
public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults(array('catalogue'=>'messages',
));
}
public function buildView(FormView $view, FormInterface $form, array $options)
{
$view->vars['translation_domain'] = $options['catalogue'];
}
public function getParent()
{
return method_exists('Symfony\Component\Form\AbstractType','getBlockPrefix') ?'Symfony\Component\Form\Extension\Core\Type\ChoiceType':'choice';
}
public function getBlockPrefix()
{
return'sonata_type_translatable_choice';
}
public function getName()
{
return $this->getBlockPrefix();
}
}
}
namespace Sonata\BlockBundle\Block
{
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
interface BlockServiceInterface
{
public function buildEditForm(FormMapper $form, BlockInterface $block);
public function buildCreateForm(FormMapper $form, BlockInterface $block);
public function execute(BlockContextInterface $blockContext, Response $response = null);
public function validateBlock(ErrorElement $errorElement, BlockInterface $block);
public function getName();
public function setDefaultSettings(OptionsResolverInterface $resolver);
public function load(BlockInterface $block);
public function getJavascripts($media);
public function getStylesheets($media);
public function getCacheKeys(BlockInterface $block);
}
}
namespace Sonata\BlockBundle\Block
{
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
abstract class BaseBlockService implements BlockServiceInterface
{
protected $name;
protected $templating;
public function __construct($name, EngineInterface $templating)
{
$this->name = $name;
$this->templating = $templating;
}
public function renderResponse($view, array $parameters = array(), Response $response = null)
{
return $this->getTemplating()->renderResponse($view, $parameters, $response);
}
public function renderPrivateResponse($view, array $parameters = array(), Response $response = null)
{
return $this->renderResponse($view, $parameters, $response)
->setTtl(0)
->setPrivate()
;
}
public function getName()
{
return $this->name;
}
public function getTemplating()
{
return $this->templating;
}
public function buildCreateForm(FormMapper $formMapper, BlockInterface $block)
{
$this->buildEditForm($formMapper, $block);
}
public function getCacheKeys(BlockInterface $block)
{
return array('block_id'=> $block->getId(),'updated_at'=> $block->getUpdatedAt() ? $block->getUpdatedAt()->format('U') : strtotime('now'),
);
}
public function prePersist(BlockInterface $block)
{
}
public function postPersist(BlockInterface $block)
{
}
public function preUpdate(BlockInterface $block)
{
}
public function postUpdate(BlockInterface $block)
{
}
public function preRemove(BlockInterface $block)
{
}
public function postRemove(BlockInterface $block)
{
}
public function load(BlockInterface $block)
{
}
public function getJavascripts($media)
{
return array();
}
public function getStylesheets($media)
{
return array();
}
public function setDefaultSettings(OptionsResolverInterface $resolver)
{
}
public function execute(BlockContextInterface $blockContext, Response $response = null)
{
return $this->renderResponse($blockContext->getTemplate(), array('block_context'=> $blockContext,'block'=> $blockContext->getBlock(),
), $response);
}
public function buildEditForm(FormMapper $form, BlockInterface $block)
{
}
public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
{
}
}
}
namespace Sonata\BlockBundle\Block
{
interface BlockLoaderInterface
{
public function load($name);
public function support($name);
}
}
namespace Sonata\BlockBundle\Block
{
use Sonata\BlockBundle\Exception\BlockNotFoundException;
class BlockLoaderChain implements BlockLoaderInterface
{
protected $loaders;
public function __construct(array $loaders)
{
$this->loaders = $loaders;
}
public function load($block)
{
foreach ($this->loaders as $loader) {
if ($loader->support($block)) {
return $loader->load($block);
}
}
throw new BlockNotFoundException();
}
public function support($name)
{
return true;
}
}
}
namespace Sonata\BlockBundle\Block
{
use Symfony\Component\HttpFoundation\Response;
interface BlockRendererInterface
{
public function render(BlockContextInterface $name, Response $response = null);
}
}
namespace Sonata\BlockBundle\Block
{
use Psr\Log\LoggerInterface;
use Sonata\BlockBundle\Exception\Strategy\StrategyManagerInterface;
use Symfony\Component\HttpFoundation\Response;
class BlockRenderer implements BlockRendererInterface
{
protected $blockServiceManager;
protected $exceptionStrategyManager;
protected $logger;
protected $debug;
private $lastResponse;
public function __construct(BlockServiceManagerInterface $blockServiceManager, StrategyManagerInterface $exceptionStrategyManager, LoggerInterface $logger = null, $debug = false)
{
$this->blockServiceManager = $blockServiceManager;
$this->exceptionStrategyManager = $exceptionStrategyManager;
$this->logger = $logger;
$this->debug = $debug;
}
public function render(BlockContextInterface $blockContext, Response $response = null)
{
$block = $blockContext->getBlock();
if ($this->logger) {
$this->logger->info(sprintf('[cms::renderBlock] block.id=%d, block.type=%s ', $block->getId(), $block->getType()));
}
try {
$service = $this->blockServiceManager->get($block);
$service->load($block);
$response = $service->execute($blockContext, $this->createResponse($blockContext, $response));
if (!$response instanceof Response) {
$response = null;
throw new \RuntimeException('A block service must return a Response object');
}
$response = $this->addMetaInformation($response, $blockContext, $service);
} catch (\Exception $exception) {
if ($this->logger) {
$this->logger->critical(sprintf('[cms::renderBlock] block.id=%d - error while rendering block - %s', $block->getId(), $exception->getMessage()));
}
$this->lastResponse = null;
$response = $this->exceptionStrategyManager->handleException($exception, $blockContext->getBlock(), $response);
}
return $response;
}
protected function createResponse(BlockContextInterface $blockContext, Response $response = null)
{
if (null === $response) {
$response = new Response();
}
if (($ttl = $blockContext->getBlock()->getTtl()) > 0) {
$response->setTtl($ttl);
}
return $response;
}
protected function addMetaInformation(Response $response, BlockContextInterface $blockContext, BlockServiceInterface $service)
{
if ($this->lastResponse && $this->lastResponse->isCacheable()) {
$response->setTtl($this->lastResponse->getTtl());
$response->setPublic();
} elseif ($this->lastResponse) { $response->setPrivate();
$response->setTtl(0);
$response->headers->removeCacheControlDirective('s-maxage');
$response->headers->removeCacheControlDirective('maxage');
}
if (!$blockContext->getBlock()->hasParent()) {
$this->lastResponse = null;
} else { $this->lastResponse = $response;
}
return $response;
}
}
}
namespace Sonata\BlockBundle\Block
{
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Model\BlockInterface;
interface BlockServiceManagerInterface
{
public function add($name, $service, $contexts = array());
public function get(BlockInterface $block);
public function setServices(array $blockServices);
public function getServices();
public function getServicesByContext($name, $includeContainers = true);
public function has($name);
public function getService($name);
public function getLoadedServices();
public function validate(ErrorElement $errorElement, BlockInterface $block);
}
}
namespace Sonata\BlockBundle\Block
{
use Psr\Log\LoggerInterface;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
class BlockServiceManager implements BlockServiceManagerInterface
{
protected $services;
protected $container;
protected $inValidate;
protected $contexts;
public function __construct(ContainerInterface $container, $debug, LoggerInterface $logger = null)
{
$this->services = array();
$this->contexts = array();
$this->container = $container;
}
private function load($type)
{
if (!$this->has($type)) {
throw new \RuntimeException(sprintf('The block service `%s` does not exist', $type));
}
if (!$this->services[$type] instanceof BlockServiceInterface) {
$this->services[$type] = $this->container->get($type);
}
if (!$this->services[$type] instanceof BlockServiceInterface) {
throw new \RuntimeException(sprintf('The service %s does not implement BlockServiceInterface', $type));
}
return $this->services[$type];
}
public function get(BlockInterface $block)
{
$this->load($block->getType());
return $this->services[$block->getType()];
}
public function getService($id)
{
return $this->load($id);
}
public function has($id)
{
return isset($this->services[$id]) ? true : false;
}
public function add($name, $service, $contexts = array())
{
$this->services[$name] = $service;
foreach ($contexts as $context) {
if (!array_key_exists($context, $this->contexts)) {
$this->contexts[$context] = array();
}
$this->contexts[$context][] = $name;
}
}
public function setServices(array $blockServices)
{
foreach ($blockServices as $name => $service) {
$this->add($name, $service);
}
}
public function getServices()
{
foreach ($this->services as $name => $id) {
if (is_string($id)) {
$this->load($id);
}
}
return $this->sortServices($this->services);
}
public function getServicesByContext($context, $includeContainers = true)
{
if (!array_key_exists($context, $this->contexts)) {
return array();
}
$services = array();
$containers = $this->container->getParameter('sonata.block.container.types');
foreach ($this->contexts[$context] as $name) {
if (!$includeContainers && in_array($name, $containers)) {
continue;
}
$services[$name] = $this->getService($name);
}
return $this->sortServices($services);
}
public function getLoadedServices()
{
$services = array();
foreach ($this->services as $service) {
if (!$service instanceof BlockServiceInterface) {
continue;
}
$services[] = $service;
}
return $services;
}
public function validate(ErrorElement $errorElement, BlockInterface $block)
{
if (!$block->getId() && !$block->getType()) {
return;
}
if ($this->inValidate) {
return;
}
try {
$this->inValidate = true;
$this->get($block)->validateBlock($errorElement, $block);
$this->inValidate = false;
} catch (\Exception $e) {
$this->inValidate = false;
}
}
private function sortServices($services)
{
uasort($services, function ($a, $b) {
if ($a->getName() == $b->getName()) {
return 0;
}
return ($a->getName() < $b->getName()) ? -1 : 1;
});
return $services;
}
}
}
namespace Sonata\BlockBundle\Block\Loader
{
use Sonata\BlockBundle\Block\BlockLoaderInterface;
use Sonata\BlockBundle\Model\Block;
class ServiceLoader implements BlockLoaderInterface
{
protected $types;
public function __construct(array $types)
{
$this->types = $types;
}
public function load($configuration)
{
if (!in_array($configuration['type'], $this->types)) {
throw new \RuntimeException(sprintf('The block type "%s" does not exist',
$configuration['type']
));
}
$block = new Block();
$block->setId(uniqid());
$block->setType($configuration['type']);
$block->setEnabled(true);
$block->setCreatedAt(new \DateTime());
$block->setUpdatedAt(new \DateTime());
$block->setSettings(isset($configuration['settings']) ? $configuration['settings'] : array());
return $block;
}
public function support($configuration)
{
if (!is_array($configuration)) {
return false;
}
if (!isset($configuration['type'])) {
return false;
}
return true;
}
}
}
namespace Sonata\BlockBundle\Block\Service
{
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\HttpFoundation\Response;
class EmptyBlockService extends BaseBlockService
{
public function buildEditForm(FormMapper $form, BlockInterface $block)
{
throw new \RuntimeException('Not used, this block renders an empty result if no block document can be found');
}
public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
{
throw new \RuntimeException('Not used, this block renders an empty result if no block document can be found');
}
public function execute(BlockContextInterface $blockContext, Response $response = null)
{
return new Response();
}
}
}
namespace Sonata\BlockBundle\Block\Service
{
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class RssBlockService extends BaseBlockService
{
public function getName()
{
return'Rss Reader';
}
public function setDefaultSettings(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('url'=> false,'title'=>'Insert the rss title','template'=>'SonataBlockBundle:Block:block_core_rss.html.twig',
));
}
public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
{
$formMapper->add('settings','sonata_type_immutable_array', array('keys'=> array(
array('url','url', array('required'=> false)),
array('title','text', array('required'=> false)),
),
));
}
public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
{
$errorElement
->with('settings[url]')
->assertNotNull(array())
->assertNotBlank()
->end()
->with('settings[title]')
->assertNotNull(array())
->assertNotBlank()
->assertMaxLength(array('limit'=> 50))
->end();
}
public function execute(BlockContextInterface $blockContext, Response $response = null)
{
$settings = $blockContext->getSettings();
$feeds = false;
if ($settings['url']) {
$options = array('http'=> array('user_agent'=>'Sonata/RSS Reader','timeout'=> 2,
),
);
$content = @file_get_contents($settings['url'], false, stream_context_create($options));
if ($content) {
try {
$feeds = new \SimpleXMLElement($content);
$feeds = $feeds->channel->item;
} catch (\Exception $e) {
}
}
}
return $this->renderResponse($blockContext->getTemplate(), array('feeds'=> $feeds,'block'=> $blockContext->getBlock(),'settings'=> $settings,
), $response);
}
}
}
namespace Sonata\BlockBundle\Block\Service
{
use Knp\Menu\ItemInterface;
use Knp\Menu\Provider\MenuProviderInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class MenuBlockService extends BaseBlockService
{
protected $menuProvider;
protected $menus;
public function __construct($name, EngineInterface $templating, MenuProviderInterface $menuProvider, array $menus = array())
{
parent::__construct($name, $templating);
$this->menuProvider = $menuProvider;
$this->menus = $menus;
}
public function execute(BlockContextInterface $blockContext, Response $response = null)
{
$responseSettings = array('menu'=> $this->getMenu($blockContext),'menu_options'=> $this->getMenuOptions($blockContext->getSettings()),'block'=> $blockContext->getBlock(),'context'=> $blockContext,
);
if ('private'=== $blockContext->getSettings('cache_policy')) {
return $this->renderPrivateResponse($blockContext->getTemplate(), $responseSettings, $response);
}
return $this->renderResponse($blockContext->getTemplate(), $responseSettings, $response);
}
public function buildEditForm(FormMapper $form, BlockInterface $block)
{
$form->add('settings','sonata_type_immutable_array', array('keys'=> $this->getFormSettingsKeys(),
));
}
public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
{
if (($name = $block->getSetting('menu_name')) && $name !==''&& !$this->menuProvider->has($name)) {
$errorElement->with('menu_name')
->addViolation('sonata.block.menu.not_existing', array('name'=> $name))
->end();
}
}
public function setDefaultSettings(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('title'=> $this->getName(),'cache_policy'=>'public','template'=>'SonataBlockBundle:Block:block_core_menu.html.twig','menu_name'=>'','safe_labels'=> false,'current_class'=>'active','first_class'=> false,'last_class'=> false,'current_uri'=> null,'menu_class'=>'list-group','children_class'=>'list-group-item','menu_template'=> null,
));
}
public function getName()
{
return'Menu';
}
protected function getFormSettingsKeys()
{
return array(
array('title','text', array('required'=> false)),
array('cache_policy','choice', array('choices'=> array('public','private'))),
array('menu_name','choice', array('choices'=> $this->menus,'required'=> false)),
array('safe_labels','checkbox', array('required'=> false)),
array('current_class','text', array('required'=> false)),
array('first_class','text', array('required'=> false)),
array('last_class','text', array('required'=> false)),
array('menu_class','text', array('required'=> false)),
array('children_class','text', array('required'=> false)),
array('menu_template','text', array('required'=> false)),
);
}
protected function getMenu(BlockContextInterface $blockContext)
{
$settings = $blockContext->getSettings();
return $settings['menu_name'];
}
protected function getMenuOptions(array $settings)
{
$mapping = array('current_class'=>'currentClass','first_class'=>'firstClass','last_class'=>'lastClass','safe_labels'=>'allow_safe_labels','menu_template'=>'template',
);
$options = array();
foreach ($settings as $key => $value) {
if (array_key_exists($key, $mapping) && null !== $value) {
$options[$mapping[$key]] = $value;
}
}
return $options;
}
}
}
namespace Sonata\BlockBundle\Block\Service
{
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class TextBlockService extends BaseBlockService
{
public function execute(BlockContextInterface $blockContext, Response $response = null)
{
return $this->renderResponse($blockContext->getTemplate(), array('block'=> $blockContext->getBlock(),'settings'=> $blockContext->getSettings(),
), $response);
}
public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
{
}
public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
{
$formMapper->add('settings','sonata_type_immutable_array', array('keys'=> array(
array('content','textarea', array()),
),
));
}
public function getName()
{
return'Text (core)';
}
public function setDefaultSettings(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('content'=>'Insert your custom content here','template'=>'SonataBlockBundle:Block:block_core_text.html.twig',
));
}
}
}
namespace Sonata\BlockBundle\Exception
{
interface BlockExceptionInterface
{
}
}
namespace Symfony\Component\HttpKernel\Exception
{
interface HttpExceptionInterface
{
public function getStatusCode();
public function getHeaders();
}
}
namespace Symfony\Component\HttpKernel\Exception
{
class HttpException extends \RuntimeException implements HttpExceptionInterface
{
private $statusCode;
private $headers;
public function __construct($statusCode, $message = null, \Exception $previous = null, array $headers = array(), $code = 0)
{
$this->statusCode = $statusCode;
$this->headers = $headers;
parent::__construct($message, $code, $previous);
}
public function getStatusCode()
{
return $this->statusCode;
}
public function getHeaders()
{
return $this->headers;
}
}
}
namespace Symfony\Component\HttpKernel\Exception
{
class NotFoundHttpException extends HttpException
{
public function __construct($message = null, \Exception $previous = null, $code = 0)
{
parent::__construct(404, $message, $previous, array(), $code);
}
}
}
namespace Sonata\BlockBundle\Exception
{
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
class BlockNotFoundException extends NotFoundHttpException
{
}
}
namespace Sonata\BlockBundle\Exception\Filter
{
use Sonata\BlockBundle\Model\BlockInterface;
interface FilterInterface
{
public function handle(\Exception $exception, BlockInterface $block);
}
}
namespace Sonata\BlockBundle\Exception\Filter
{
use Sonata\BlockBundle\Model\BlockInterface;
class DebugOnlyFilter implements FilterInterface
{
protected $debug;
public function __construct($debug)
{
$this->debug = $debug;
}
public function handle(\Exception $exception, BlockInterface $block)
{
return $this->debug ? true : false;
}
}
}
namespace Sonata\BlockBundle\Exception\Filter
{
use Sonata\BlockBundle\Model\BlockInterface;
class IgnoreClassFilter implements FilterInterface
{
protected $class;
public function __construct($class)
{
$this->class = $class;
}
public function handle(\Exception $exception, BlockInterface $block)
{
return !$exception instanceof $this->class;
}
}
}
namespace Sonata\BlockBundle\Exception\Filter
{
use Sonata\BlockBundle\Model\BlockInterface;
class KeepAllFilter implements FilterInterface
{
public function handle(\Exception $exception, BlockInterface $block)
{
return true;
}
}
}
namespace Sonata\BlockBundle\Exception\Filter
{
use Sonata\BlockBundle\Model\BlockInterface;
class KeepNoneFilter implements FilterInterface
{
public function handle(\Exception $exception, BlockInterface $block)
{
return false;
}
}
}
namespace Sonata\BlockBundle\Exception\Renderer
{
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\HttpFoundation\Response;
interface RendererInterface
{
public function render(\Exception $exception, BlockInterface $block, Response $response = null);
}
}
namespace Sonata\BlockBundle\Exception\Renderer
{
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\FlattenException;
use Symfony\Component\Templating\EngineInterface;
class InlineDebugRenderer implements RendererInterface
{
protected $templating;
protected $template;
protected $forceStyle;
protected $debug;
public function __construct(EngineInterface $templating, $template, $debug, $forceStyle = true)
{
$this->templating = $templating;
$this->template = $template;
$this->debug = $debug;
$this->forceStyle = $forceStyle;
}
public function render(\Exception $exception, BlockInterface $block, Response $response = null)
{
$response = $response ?: new Response();
if (!$this->debug) {
return $response;
}
$flattenException = FlattenException::create($exception);
$code = $flattenException->getStatusCode();
$parameters = array('exception'=> $flattenException,'status_code'=> $code,'status_text'=> isset(Response::$statusTexts[$code]) ? Response::$statusTexts[$code] :'','logger'=> false,'currentContent'=> false,'block'=> $block,'forceStyle'=> $this->forceStyle,
);
$content = $this->templating->render($this->template, $parameters);
$response->setContent($content);
return $response;
}
}
}
namespace Sonata\BlockBundle\Exception\Renderer
{
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;
class InlineRenderer implements RendererInterface
{
protected $templating;
protected $template;
public function __construct(EngineInterface $templating, $template)
{
$this->templating = $templating;
$this->template = $template;
}
public function render(\Exception $exception, BlockInterface $block, Response $response = null)
{
$parameters = array('exception'=> $exception,'block'=> $block,
);
$content = $this->templating->render($this->template, $parameters);
$response = $response ?: new Response();
$response->setContent($content);
return $response;
}
}
}
namespace Sonata\BlockBundle\Exception\Renderer
{
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\HttpFoundation\Response;
class MonkeyThrowRenderer implements RendererInterface
{
public function render(\Exception $banana, BlockInterface $block, Response $response = null)
{
throw $banana;
}
}
}
namespace Sonata\BlockBundle\Exception\Strategy
{
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\HttpFoundation\Response;
interface StrategyManagerInterface
{
public function handleException(\Exception $exception, BlockInterface $block, Response $response = null);
}
}
namespace Sonata\BlockBundle\Exception\Strategy
{
use Sonata\BlockBundle\Exception\Filter\FilterInterface;
use Sonata\BlockBundle\Exception\Renderer\RendererInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
class StrategyManager implements StrategyManagerInterface
{
protected $container;
protected $filters;
protected $renderers;
protected $blockFilters;
protected $blockRenderers;
protected $defaultFilter;
protected $defaultRenderer;
public function __construct(ContainerInterface $container, array $filters, array $renderers, array $blockFilters, array $blockRenderers)
{
$this->container = $container;
$this->filters = $filters;
$this->renderers = $renderers;
$this->blockFilters = $blockFilters;
$this->blockRenderers = $blockRenderers;
}
public function setDefaultFilter($name)
{
if (!array_key_exists($name, $this->filters)) {
throw new \InvalidArgumentException(sprintf('Cannot set default exception filter "%s". It does not exist.', $name));
}
$this->defaultFilter = $name;
}
public function setDefaultRenderer($name)
{
if (!array_key_exists($name, $this->renderers)) {
throw new \InvalidArgumentException(sprintf('Cannot set default exception renderer "%s". It does not exist.', $name));
}
$this->defaultRenderer = $name;
}
public function handleException(\Exception $exception, BlockInterface $block, Response $response = null)
{
$response = $response ?: new Response();
$response->setPrivate();
$filter = $this->getBlockFilter($block);
if ($filter->handle($exception, $block)) {
$renderer = $this->getBlockRenderer($block);
$response = $renderer->render($exception, $block, $response);
} else {
}
return $response;
}
public function getBlockRenderer(BlockInterface $block)
{
$type = $block->getType();
$name = isset($this->blockRenderers[$type]) ? $this->blockRenderers[$type] : $this->defaultRenderer;
$service = $this->getRendererService($name);
if (!$service instanceof RendererInterface) {
throw new \RuntimeException(sprintf('The service "%s" is not an exception renderer', $name));
}
return $service;
}
public function getBlockFilter(BlockInterface $block)
{
$type = $block->getType();
$name = isset($this->blockFilters[$type]) ? $this->blockFilters[$type] : $this->defaultFilter;
$service = $this->getFilterService($name);
if (!$service instanceof FilterInterface) {
throw new \RuntimeException(sprintf('The service "%s" is not an exception filter', $name));
}
return $service;
}
protected function getFilterService($name)
{
if (!isset($this->filters[$name])) {
throw new \RuntimeException('The filter "%s" does not exist.');
}
return $this->container->get($this->filters[$name]);
}
protected function getRendererService($name)
{
if (!isset($this->renderers[$name])) {
throw new \RuntimeException('The renderer "%s" does not exist.');
}
return $this->container->get($this->renderers[$name]);
}
}
}
namespace Sonata\BlockBundle\Form\Type
{
use Sonata\BlockBundle\Block\BlockServiceManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class ServiceListType extends AbstractType
{
protected $manager;
public function __construct(BlockServiceManagerInterface $manager)
{
$this->manager = $manager;
}
public function getName()
{
return'sonata_block_service_choice';
}
public function getParent()
{
return'choice';
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$manager = $this->manager;
$resolver->setRequired(array('context',
));
$resolver->setDefaults(array('multiple'=> false,'expanded'=> false,'choices'=> function (Options $options, $previousValue) use ($manager) {
$types = array();
foreach ($manager->getServicesByContext($options['context'], $options['include_containers']) as $code => $service) {
$types[$code] = sprintf('%s - %s', $service->getName(), $code);
}
return $types;
},'preferred_choices'=> array(),'empty_data'=> function (Options $options) {
$multiple = isset($options['multiple']) && $options['multiple'];
$expanded = isset($options['expanded']) && $options['expanded'];
return $multiple || $expanded ? array() :'';
},'empty_value'=> function (Options $options, $previousValue) {
$multiple = isset($options['multiple']) && $options['multiple'];
$expanded = isset($options['expanded']) && $options['expanded'];
return $multiple || $expanded || !isset($previousValue) ? null :'';
},'error_bubbling'=> false,'include_containers'=> false,
));
}
}
}
namespace Sonata\BlockBundle\Model
{
interface BlockInterface
{
public function setId($id);
public function getId();
public function setName($name);
public function getName();
public function setType($type);
public function getType();
public function setEnabled($enabled);
public function getEnabled();
public function setPosition($position);
public function getPosition();
public function setCreatedAt(\DateTime $createdAt = null);
public function getCreatedAt();
public function setUpdatedAt(\DateTime $updatedAt = null);
public function getUpdatedAt();
public function getTtl();
public function setSettings(array $settings = array());
public function getSettings();
public function setSetting($name, $value);
public function getSetting($name, $default = null);
public function addChildren(BlockInterface $children);
public function getChildren();
public function hasChildren();
public function setParent(BlockInterface $parent = null);
public function getParent();
public function hasParent();
}
}
namespace Sonata\BlockBundle\Model
{
abstract class BaseBlock implements BlockInterface
{
protected $name;
protected $settings;
protected $enabled;
protected $position;
protected $parent;
protected $children;
protected $createdAt;
protected $updatedAt;
protected $type;
protected $ttl;
public function __construct()
{
$this->settings = array();
$this->enabled = false;
$this->children = array();
}
public function setName($name)
{
$this->name = $name;
}
public function getName()
{
return $this->name;
}
public function setType($type)
{
$this->type = $type;
}
public function getType()
{
return $this->type;
}
public function setSettings(array $settings = array())
{
$this->settings = $settings;
}
public function getSettings()
{
return $this->settings;
}
public function setSetting($name, $value)
{
$this->settings[$name] = $value;
}
public function getSetting($name, $default = null)
{
return isset($this->settings[$name]) ? $this->settings[$name] : $default;
}
public function setEnabled($enabled)
{
$this->enabled = $enabled;
}
public function getEnabled()
{
return $this->enabled;
}
public function setPosition($position)
{
$this->position = $position;
}
public function getPosition()
{
return $this->position;
}
public function setCreatedAt(\DateTime $createdAt = null)
{
$this->createdAt = $createdAt;
}
public function getCreatedAt()
{
return $this->createdAt;
}
public function setUpdatedAt(\DateTime $updatedAt = null)
{
$this->updatedAt = $updatedAt;
}
public function getUpdatedAt()
{
return $this->updatedAt;
}
public function addChildren(BlockInterface $child)
{
$this->children[] = $child;
$child->setParent($this);
}
public function getChildren()
{
return $this->children;
}
public function setParent(BlockInterface $parent = null)
{
$this->parent = $parent;
}
public function getParent()
{
return $this->parent;
}
public function hasParent()
{
return $this->getParent() instanceof self;
}
public function __toString()
{
return sprintf('%s ~ #%s', $this->getname(), $this->getId());
}
public function getTtl()
{
if (!$this->getSetting('use_cache', true)) {
return 0;
}
$ttl = $this->getSetting('ttl', 86400);
foreach ($this->getChildren() as $block) {
$blockTtl = $block->getTtl();
$ttl = ($blockTtl < $ttl) ? $blockTtl : $ttl;
}
$this->ttl = $ttl;
return $this->ttl;
}
public function hasChildren()
{
return count($this->children) > 0;
}
}
}
namespace Sonata\BlockBundle\Model
{
class Block extends BaseBlock
{
protected $id;
public function setId($id)
{
$this->id = $id;
}
public function getId()
{
return $this->id;
}
}
}
namespace Sonata\CoreBundle\Model
{
use Doctrine\DBAL\Connection;
interface ManagerInterface
{
public function getClass();
public function findAll();
public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);
public function findOneBy(array $criteria, array $orderBy = null);
public function find($id);
public function create();
public function save($entity, $andFlush = true);
public function delete($entity, $andFlush = true);
public function getTableName();
public function getConnection();
}
}
namespace Sonata\CoreBundle\Model
{
use Sonata\DatagridBundle\Pager\PagerInterface;
interface PageableManagerInterface
{
public function getPager(array $criteria, $page, $limit = 10, array $sort = array());
}
}
namespace Sonata\BlockBundle\Model
{
use Sonata\CoreBundle\Model\ManagerInterface;
use Sonata\CoreBundle\Model\PageableManagerInterface;
interface BlockManagerInterface extends ManagerInterface, PageableManagerInterface
{
}
}
namespace Sonata\BlockBundle\Model
{
class EmptyBlock extends Block
{
}
}
namespace Sonata\BlockBundle\Twig\Extension
{
use Sonata\BlockBundle\Templating\Helper\BlockHelper;
class BlockExtension extends \Twig_Extension
{
protected $blockHelper;
public function __construct(BlockHelper $blockHelper)
{
$this->blockHelper = $blockHelper;
}
public function getFunctions()
{
return array(
new \Twig_SimpleFunction('sonata_block_render',
array($this->blockHelper,'render'),
array('is_safe'=> array('html'))
),
new \Twig_SimpleFunction('sonata_block_render_event',
array($this->blockHelper,'renderEvent'),
array('is_safe'=> array('html'))
),
new \Twig_SimpleFunction('sonata_block_include_javascripts',
array($this->blockHelper,'includeJavascripts'),
array('is_safe'=> array('html'))
),
new \Twig_SimpleFunction('sonata_block_include_stylesheets',
array($this->blockHelper,'includeStylesheets'),
array('is_safe'=> array('html'))
),
);
}
public function getName()
{
return'sonata_block';
}
}
}
namespace Sonata\BlockBundle\Twig
{
class GlobalVariables
{
protected $templates;
public function __construct(array $templates)
{
$this->templates = $templates;
}
public function getTemplates()
{
return $this->templates;
}
}
}
namespace Sonata\AdminBundle\Admin
{
use Knp\Menu\FactoryInterface as MenuFactoryInterface;
use Sonata\AdminBundle\Builder\DatagridBuilderInterface;
use Sonata\AdminBundle\Builder\FormContractorInterface;
use Sonata\AdminBundle\Builder\ListBuilderInterface;
use Sonata\AdminBundle\Builder\RouteBuilderInterface;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Sonata\AdminBundle\Route\RouteGeneratorInterface;
use Sonata\AdminBundle\Security\Handler\SecurityHandlerInterface;
use Sonata\AdminBundle\Translator\LabelTranslatorStrategyInterface;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\CoreBundle\Model\Metadata;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Validator\ValidatorInterface;
interface AdminInterface
{
public function setFormContractor(FormContractorInterface $formContractor);
public function setListBuilder(ListBuilderInterface $listBuilder);
public function getListBuilder();
public function setDatagridBuilder(DatagridBuilderInterface $datagridBuilder);
public function getDatagridBuilder();
public function setTranslator(TranslatorInterface $translator);
public function getTranslator();
public function setRequest(Request $request);
public function setConfigurationPool(Pool $pool);
public function setRouteGenerator(RouteGeneratorInterface $routeGenerator);
public function getClass();
public function attachAdminClass(FieldDescriptionInterface $fieldDescription);
public function getDatagrid();
public function setBaseControllerName($baseControllerName);
public function getBaseControllerName();
public function generateObjectUrl($name, $object, array $parameters = array(), $absolute = false);
public function generateUrl($name, array $parameters = array(), $absolute = false);
public function generateMenuUrl($name, array $parameters = array(), $absolute = false);
public function getModelManager();
public function getManagerType();
public function createQuery($context ='list');
public function getFormBuilder();
public function getFormFieldDescription($name);
public function getFormFieldDescriptions();
public function getForm();
public function getRequest();
public function hasRequest();
public function getCode();
public function getBaseCodeRoute();
public function getSecurityInformation();
public function setParentFieldDescription(FieldDescriptionInterface $parentFieldDescription);
public function getParentFieldDescription();
public function hasParentFieldDescription();
public function trans($id, array $parameters = array(), $domain = null, $locale = null);
public function getRoutes();
public function getRouterIdParameter();
public function getIdParameter();
public function hasShowFieldDescription($name);
public function addShowFieldDescription($name, FieldDescriptionInterface $fieldDescription);
public function removeShowFieldDescription($name);
public function addListFieldDescription($name, FieldDescriptionInterface $fieldDescription);
public function removeListFieldDescription($name);
public function hasFilterFieldDescription($name);
public function addFilterFieldDescription($name, FieldDescriptionInterface $fieldDescription);
public function removeFilterFieldDescription($name);
public function getFilterFieldDescriptions();
public function getList();
public function setSecurityHandler(SecurityHandlerInterface $securityHandler);
public function getSecurityHandler();
public function isGranted($name, $object = null);
public function getUrlsafeIdentifier($entity);
public function getNormalizedIdentifier($entity);
public function id($entity);
public function setValidator(ValidatorInterface $validator);
public function getValidator();
public function getShow();
public function setFormTheme(array $formTheme);
public function getFormTheme();
public function setFilterTheme(array $filterTheme);
public function getFilterTheme();
public function addExtension(AdminExtensionInterface $extension);
public function getExtensions();
public function setMenuFactory(MenuFactoryInterface $menuFactory);
public function getMenuFactory();
public function setRouteBuilder(RouteBuilderInterface $routeBuilder);
public function getRouteBuilder();
public function toString($object);
public function setLabelTranslatorStrategy(LabelTranslatorStrategyInterface $labelTranslatorStrategy);
public function getLabelTranslatorStrategy();
public function supportsPreviewMode();
public function addChild(AdminInterface $child);
public function hasChild($code);
public function getChildren();
public function getChild($code);
public function getNewInstance();
public function setUniqid($uniqId);
public function getUniqid();
public function getObject($id);
public function setSubject($subject);
public function getSubject();
public function getListFieldDescription($name);
public function hasListFieldDescription($name);
public function getListFieldDescriptions();
public function getExportFormats();
public function getDataSourceIterator();
public function configure();
public function update($object);
public function create($object);
public function delete($object);
public function preUpdate($object);
public function postUpdate($object);
public function prePersist($object);
public function postPersist($object);
public function preRemove($object);
public function postRemove($object);
public function preBatchAction($actionName, ProxyQueryInterface $query, array &$idx, $allElements);
public function getFilterParameters();
public function hasSubject();
public function validate(ErrorElement $errorElement, $object);
public function showIn($context);
public function createObjectSecurity($object);
public function getParent();
public function setParent(AdminInterface $admin);
public function isChild();
public function getTemplate($name);
public function setTranslationDomain($translationDomain);
public function getTranslationDomain();
public function getFormGroups();
public function setFormGroups(array $formGroups);
public function getFormTabs();
public function setFormTabs(array $formTabs);
public function getShowTabs();
public function setShowTabs(array $showTabs);
public function removeFieldFromFormGroup($key);
public function getShowGroups();
public function setShowGroups(array $showGroups);
public function reorderShowGroup($group, array $keys);
public function addFormFieldDescription($name, FieldDescriptionInterface $fieldDescription);
public function removeFormFieldDescription($name);
public function isAclEnabled();
public function setSubClasses(array $subClasses);
public function hasSubClass($name);
public function hasActiveSubClass();
public function getActiveSubClass();
public function getActiveSubclassCode();
public function getBatchActions();
public function getLabel();
public function getPersistentParameters();
public function getBreadcrumbs($action);
public function setCurrentChild($currentChild);
public function getCurrentChild();
public function getTranslationLabel($label, $context ='', $type ='');
public function buildSideMenu($action, AdminInterface $childAdmin = null);
public function buildTabMenu($action, AdminInterface $childAdmin = null);
public function getObjectMetadata($object);
}
}
namespace Symfony\Component\Security\Acl\Model
{
interface DomainObjectInterface
{
public function getObjectIdentifier();
}
}
namespace Sonata\AdminBundle\Admin
{
use Doctrine\Common\Util\ClassUtils;
use Knp\Menu\FactoryInterface as MenuFactoryInterface;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Builder\DatagridBuilderInterface;
use Sonata\AdminBundle\Builder\FormContractorInterface;
use Sonata\AdminBundle\Builder\ListBuilderInterface;
use Sonata\AdminBundle\Builder\RouteBuilderInterface;
use Sonata\AdminBundle\Builder\ShowBuilderInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Model\ModelManagerInterface;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Route\RouteGeneratorInterface;
use Sonata\AdminBundle\Security\Handler\AclSecurityHandlerInterface;
use Sonata\AdminBundle\Security\Handler\SecurityHandlerInterface;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Translator\LabelTranslatorStrategyInterface;
use Sonata\AdminBundle\Validator\Constraints\InlineConstraint;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\CoreBundle\Model\Metadata;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyPath;
use Symfony\Component\Security\Acl\Model\DomainObjectInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Validator\ValidatorInterface;
abstract class Admin implements AdminInterface, DomainObjectInterface
{
const CONTEXT_MENU ='menu';
const CONTEXT_DASHBOARD ='dashboard';
const CLASS_REGEX ='@(?:([A-Za-z0-9]*)\\\)?(Bundle\\\)?([A-Za-z0-9]+?)(?:Bundle)?\\\(Entity|Document|Model|PHPCR|CouchDocument|Phpcr|Doctrine\\\Orm|Doctrine\\\Phpcr|Doctrine\\\MongoDB|Doctrine\\\CouchDB)\\\(.*)@';
private $class;
private $subClasses = array();
private $list;
protected $listFieldDescriptions = array();
private $show;
protected $showFieldDescriptions = array();
private $form;
protected $formFieldDescriptions = array();
private $filter;
protected $filterFieldDescriptions = array();
protected $maxPerPage = 25;
protected $maxPageLinks = 25;
protected $baseRouteName;
protected $baseRoutePattern;
protected $baseControllerName;
private $formGroups = false;
private $formTabs = false;
private $showGroups = false;
private $showTabs = false;
protected $classnameLabel;
protected $translationDomain ='messages';
protected $formOptions = array();
protected $datagridValues = array('_page'=> 1,'_per_page'=> 25,
);
protected $perPageOptions = array(15, 25, 50, 100, 150, 200);
protected $code;
protected $label;
protected $persistFilters = false;
protected $routes;
protected $subject;
protected $children = array();
protected $parent = null;
protected $baseCodeRoute ='';
protected $parentAssociationMapping = null;
protected $parentFieldDescription;
protected $currentChild = false;
protected $uniqid;
protected $modelManager;
private $managerType;
protected $request;
protected $translator;
protected $formContractor;
protected $listBuilder;
protected $showBuilder;
protected $datagridBuilder;
protected $routeBuilder;
protected $datagrid;
protected $routeGenerator;
protected $breadcrumbs = array();
protected $securityHandler = null;
protected $validator = null;
protected $configurationPool;
protected $menu;
protected $menuFactory;
protected $loaded = array('view_fields'=> false,'view_groups'=> false,'routes'=> false,'tab_menu'=> false,
);
protected $formTheme = array();
protected $filterTheme = array();
protected $templates = array();
protected $extensions = array();
protected $labelTranslatorStrategy;
protected $supportsPreviewMode = false;
protected $securityInformation = array();
protected $cacheIsGranted = array();
protected function configureFormFields(FormMapper $form)
{
}
protected function configureListFields(ListMapper $list)
{
}
protected function configureDatagridFilters(DatagridMapper $filter)
{
}
protected function configureShowFields(ShowMapper $filter)
{
}
protected function configureRoutes(RouteCollection $collection)
{
}
protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
{
}
protected function configureTabMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
{
$this->configureSideMenu($menu, $action, $childAdmin);
}
public function getExportFormats()
{
return array('json','xml','csv','xls',
);
}
public function getExportFields()
{
return $this->getModelManager()->getExportFields($this->getClass());
}
public function getDataSourceIterator()
{
$datagrid = $this->getDatagrid();
$datagrid->buildPager();
return $this->getModelManager()->getDataSourceIterator($datagrid, $this->getExportFields());
}
public function validate(ErrorElement $errorElement, $object)
{
}
public function __construct($code, $class, $baseControllerName)
{
$this->code = $code;
$this->class = $class;
$this->baseControllerName = $baseControllerName;
$this->predefinePerPageOptions();
$this->datagridValues['_per_page'] = $this->maxPerPage;
}
public function initialize()
{
if (!$this->classnameLabel) {
$this->classnameLabel = substr($this->getClass(), strrpos($this->getClass(),'\\') + 1);
}
$this->baseCodeRoute = $this->getCode();
$this->configure();
}
public function configure()
{
}
public function update($object)
{
$this->preUpdate($object);
foreach ($this->extensions as $extension) {
$extension->preUpdate($this, $object);
}
$result = $this->getModelManager()->update($object);
if (null !== $result) {
$object = $result;
}
$this->postUpdate($object);
foreach ($this->extensions as $extension) {
$extension->postUpdate($this, $object);
}
return $object;
}
public function create($object)
{
$this->prePersist($object);
foreach ($this->extensions as $extension) {
$extension->prePersist($this, $object);
}
$result = $this->getModelManager()->create($object);
if (null !== $result) {
$object = $result;
}
$this->postPersist($object);
foreach ($this->extensions as $extension) {
$extension->postPersist($this, $object);
}
$this->createObjectSecurity($object);
return $object;
}
public function delete($object)
{
$this->preRemove($object);
foreach ($this->extensions as $extension) {
$extension->preRemove($this, $object);
}
$this->getSecurityHandler()->deleteObjectSecurity($this, $object);
$this->getModelManager()->delete($object);
$this->postRemove($object);
foreach ($this->extensions as $extension) {
$extension->postRemove($this, $object);
}
}
public function preUpdate($object)
{
}
public function postUpdate($object)
{
}
public function prePersist($object)
{
}
public function postPersist($object)
{
}
public function preRemove($object)
{
}
public function postRemove($object)
{
}
public function preBatchAction($actionName, ProxyQueryInterface $query, array &$idx, $allElements)
{
}
protected function buildShow()
{
if ($this->show) {
return;
}
$this->show = new FieldDescriptionCollection();
$mapper = new ShowMapper($this->showBuilder, $this->show, $this);
$this->configureShowFields($mapper);
foreach ($this->getExtensions() as $extension) {
$extension->configureShowFields($mapper);
}
}
protected function buildList()
{
if ($this->list) {
return;
}
$this->list = $this->getListBuilder()->getBaseList();
$mapper = new ListMapper($this->getListBuilder(), $this->list, $this);
if (count($this->getBatchActions()) > 0) {
$fieldDescription = $this->getModelManager()->getNewFieldDescriptionInstance($this->getClass(),'batch', array('label'=>'batch','code'=>'_batch','sortable'=> false,
));
$fieldDescription->setAdmin($this);
$fieldDescription->setTemplate($this->getTemplate('batch'));
$mapper->add($fieldDescription,'batch');
}
$this->configureListFields($mapper);
foreach ($this->getExtensions() as $extension) {
$extension->configureListFields($mapper);
}
if ($this->hasRequest() && $this->getRequest()->isXmlHttpRequest()) {
$fieldDescription = $this->getModelManager()->getNewFieldDescriptionInstance($this->getClass(),'select', array('label'=> false,'code'=>'_select','sortable'=> false,
));
$fieldDescription->setAdmin($this);
$fieldDescription->setTemplate($this->getTemplate('select'));
$mapper->add($fieldDescription,'select');
}
}
public function getFilterParameters()
{
$parameters = array();
if ($this->hasRequest()) {
$filters = $this->request->query->get('filter', array());
if ($this->persistFilters) {
if ($filters == array() && $this->request->query->get('filters') !='reset') {
$filters = $this->request->getSession()->get($this->getCode().'.filter.parameters', array());
} else {
$this->request->getSession()->set($this->getCode().'.filter.parameters', $filters);
}
}
$parameters = array_merge(
$this->getModelManager()->getDefaultSortValues($this->getClass()),
$this->datagridValues,
$filters
);
if (!$this->determinedPerPageValue($parameters['_per_page'])) {
$parameters['_per_page'] = $this->maxPerPage;
}
if ($this->isChild() && $this->getParentAssociationMapping()) {
$name = str_replace('.','__', $this->getParentAssociationMapping());
$parameters[$name] = array('value'=> $this->request->get($this->getParent()->getIdParameter()));
}
}
return $parameters;
}
public function buildDatagrid()
{
if ($this->datagrid) {
return;
}
$filterParameters = $this->getFilterParameters();
if (isset($filterParameters['_sort_by']) && is_string($filterParameters['_sort_by'])) {
if ($this->hasListFieldDescription($filterParameters['_sort_by'])) {
$filterParameters['_sort_by'] = $this->getListFieldDescription($filterParameters['_sort_by']);
} else {
$filterParameters['_sort_by'] = $this->getModelManager()->getNewFieldDescriptionInstance(
$this->getClass(),
$filterParameters['_sort_by'],
array()
);
$this->getListBuilder()->buildField(null, $filterParameters['_sort_by'], $this);
}
}
$this->datagrid = $this->getDatagridBuilder()->getBaseDatagrid($this, $filterParameters);
$this->datagrid->getPager()->setMaxPageLinks($this->maxPageLinks);
$mapper = new DatagridMapper($this->getDatagridBuilder(), $this->datagrid, $this);
$this->configureDatagridFilters($mapper);
if ($this->isChild() && $this->getParentAssociationMapping() && !$mapper->has($this->getParentAssociationMapping())) {
$mapper->add($this->getParentAssociationMapping(), null, array('label'=> false,'field_type'=>'sonata_type_model_hidden','field_options'=> array('model_manager'=> $this->getModelManager(),
),'operator_type'=>'hidden',
));
}
foreach ($this->getExtensions() as $extension) {
$extension->configureDatagridFilters($mapper);
}
}
public function getParentAssociationMapping()
{
return $this->parentAssociationMapping;
}
protected function buildForm()
{
if ($this->form) {
return;
}
if ($this->isChild() && $this->getParentAssociationMapping()) {
$parent = $this->getParent()->getObject($this->request->get($this->getParent()->getIdParameter()));
$propertyAccessor = PropertyAccess::createPropertyAccessor();
$propertyPath = new PropertyPath($this->getParentAssociationMapping());
$object = $this->getSubject();
$value = $propertyAccessor->getValue($object, $propertyPath);
if (is_array($value) || ($value instanceof \Traversable && $value instanceof \ArrayAccess)) {
$value[] = $parent;
$propertyAccessor->setValue($object, $propertyPath, $value);
} else {
$propertyAccessor->setValue($object, $propertyPath, $parent);
}
}
$this->form = $this->getFormBuilder()->getForm();
}
public function getBaseRoutePattern()
{
if (!$this->baseRoutePattern) {
preg_match(self::CLASS_REGEX, $this->class, $matches);
if (!$matches) {
throw new \RuntimeException(sprintf('Please define a default `baseRoutePattern` value for the admin class `%s`', get_class($this)));
}
if ($this->isChild()) { $this->baseRoutePattern = sprintf('%s/{id}/%s',
$this->getParent()->getBaseRoutePattern(),
$this->urlize($matches[5],'-')
);
} else {
$this->baseRoutePattern = sprintf('/%s%s/%s',
empty($matches[1]) ?'': $this->urlize($matches[1],'-').'/',
$this->urlize($matches[3],'-'),
$this->urlize($matches[5],'-')
);
}
}
return $this->baseRoutePattern;
}
public function getBaseRouteName()
{
if (!$this->baseRouteName) {
preg_match(self::CLASS_REGEX, $this->class, $matches);
if (!$matches) {
throw new \RuntimeException(sprintf('Cannot automatically determine base route name, please define a default `baseRouteName` value for the admin class `%s`', get_class($this)));
}
if ($this->isChild()) { $this->baseRouteName = sprintf('%s_%s',
$this->getParent()->getBaseRouteName(),
$this->urlize($matches[5])
);
} else {
$this->baseRouteName = sprintf('admin_%s%s_%s',
empty($matches[1]) ?'': $this->urlize($matches[1]).'_',
$this->urlize($matches[3]),
$this->urlize($matches[5])
);
}
}
return $this->baseRouteName;
}
public function urlize($word, $sep ='_')
{
return strtolower(preg_replace('/[^a-z0-9_]/i', $sep.'$1', $word));
}
public function getClass()
{
if ($this->hasSubject() && is_object($this->getSubject())) {
return ClassUtils::getClass($this->getSubject());
}
if (!$this->hasActiveSubClass()) {
if (count($this->getSubClasses()) > 0) {
$subject = $this->getSubject();
if ($subject && is_object($subject)) {
return ClassUtils::getClass($subject);
}
}
return $this->class;
}
if ($this->getParentFieldDescription() && $this->hasActiveSubClass()) {
throw new \RuntimeException('Feature not implemented: an embedded admin cannot have subclass');
}
$subClass = $this->getRequest()->query->get('subclass');
return $this->getSubClass($subClass);
}
public function getSubClasses()
{
return $this->subClasses;
}
public function setSubClasses(array $subClasses)
{
$this->subClasses = $subClasses;
}
protected function getSubClass($name)
{
if ($this->hasSubClass($name)) {
return $this->subClasses[$name];
}
throw new \RuntimeException(sprintf('Unable to find the subclass `%s` for admin `%s`', $name, get_class($this)));
}
public function hasSubClass($name)
{
return isset($this->subClasses[$name]);
}
public function hasActiveSubClass()
{
if (count($this->subClasses) > 0 && $this->request) {
return null !== $this->getRequest()->query->get('subclass');
}
return false;
}
public function getActiveSubClass()
{
if (!$this->hasActiveSubClass()) {
return;
}
return $this->getClass();
}
public function getActiveSubclassCode()
{
if (!$this->hasActiveSubClass()) {
return;
}
$subClass = $this->getRequest()->query->get('subclass');
if (!$this->hasSubClass($subClass)) {
return;
}
return $subClass;
}
public function getBatchActions()
{
$actions = array();
if ($this->hasRoute('delete') && $this->isGranted('DELETE')) {
$actions['delete'] = array('label'=> $this->trans('action_delete', array(),'SonataAdminBundle'),'ask_confirmation'=> true, );
}
return $actions;
}
public function getRoutes()
{
$this->buildRoutes();
return $this->routes;
}
public function getRouterIdParameter()
{
return $this->isChild() ?'{childId}':'{id}';
}
public function getIdParameter()
{
return $this->isChild() ?'childId':'id';
}
private function buildRoutes()
{
if ($this->loaded['routes']) {
return;
}
$this->loaded['routes'] = true;
$this->routes = new RouteCollection(
$this->getBaseCodeRoute(),
$this->getBaseRouteName(),
$this->getBaseRoutePattern(),
$this->getBaseControllerName()
);
$this->routeBuilder->build($this, $this->routes);
$this->configureRoutes($this->routes);
foreach ($this->getExtensions() as $extension) {
$extension->configureRoutes($this, $this->routes);
}
}
public function hasRoute($name)
{
if (!$this->routeGenerator) {
throw new \RuntimeException('RouteGenerator cannot be null');
}
return $this->routeGenerator->hasAdminRoute($this, $name);
}
public function generateObjectUrl($name, $object, array $parameters = array(), $absolute = false)
{
$parameters['id'] = $this->getUrlsafeIdentifier($object);
return $this->generateUrl($name, $parameters, $absolute);
}
public function generateUrl($name, array $parameters = array(), $absolute = false)
{
return $this->routeGenerator->generateUrl($this, $name, $parameters, $absolute);
}
public function generateMenuUrl($name, array $parameters = array(), $absolute = false)
{
return $this->routeGenerator->generateMenuUrl($this, $name, $parameters, $absolute);
}
public function setTemplates(array $templates)
{
$this->templates = $templates;
}
public function setTemplate($name, $template)
{
$this->templates[$name] = $template;
}
public function getTemplates()
{
return $this->templates;
}
public function getTemplate($name)
{
if (isset($this->templates[$name])) {
return $this->templates[$name];
}
return;
}
public function getNewInstance()
{
$object = $this->getModelManager()->getModelInstance($this->getClass());
foreach ($this->getExtensions() as $extension) {
$extension->alterNewInstance($this, $object);
}
return $object;
}
public function getFormBuilder()
{
$this->formOptions['data_class'] = $this->getClass();
$formBuilder = $this->getFormContractor()->getFormBuilder(
$this->getUniqid(),
$this->formOptions
);
$this->defineFormBuilder($formBuilder);
return $formBuilder;
}
public function defineFormBuilder(FormBuilder $formBuilder)
{
$mapper = new FormMapper($this->getFormContractor(), $formBuilder, $this);
$this->configureFormFields($mapper);
foreach ($this->getExtensions() as $extension) {
$extension->configureFormFields($mapper);
}
$this->attachInlineValidator();
}
protected function attachInlineValidator()
{
$admin = $this;
$metadata = $this->validator->getMetadataFactory()->getMetadataFor($this->getClass());
$metadata->addConstraint(new InlineConstraint(array('service'=> $this,'method'=> function (ErrorElement $errorElement, $object) use ($admin) {
if ($admin->hasSubject() && spl_object_hash($object) !== spl_object_hash($admin->getSubject())) {
return;
}
$admin->validate($errorElement, $object);
foreach ($admin->getExtensions() as $extension) {
$extension->validate($admin, $errorElement, $object);
}
},
)));
}
public function attachAdminClass(FieldDescriptionInterface $fieldDescription)
{
$pool = $this->getConfigurationPool();
$adminCode = $fieldDescription->getOption('admin_code');
if ($adminCode !== null) {
$admin = $pool->getAdminByAdminCode($adminCode);
} else {
$admin = $pool->getAdminByClass($fieldDescription->getTargetEntity());
}
if (!$admin) {
return;
}
if ($this->hasRequest()) {
$admin->setRequest($this->getRequest());
}
$fieldDescription->setAssociationAdmin($admin);
}
public function getObject($id)
{
$object = $this->getModelManager()->find($this->getClass(), $id);
foreach ($this->getExtensions() as $extension) {
$extension->alterObject($this, $object);
}
return $object;
}
public function getForm()
{
$this->buildForm();
return $this->form;
}
public function getList()
{
$this->buildList();
return $this->list;
}
public function createQuery($context ='list')
{
$query = $this->getModelManager()->createQuery($this->class);
foreach ($this->extensions as $extension) {
$extension->configureQuery($this, $query, $context);
}
return $query;
}
public function getDatagrid()
{
$this->buildDatagrid();
return $this->datagrid;
}
public function buildTabMenu($action, AdminInterface $childAdmin = null)
{
if ($this->loaded['tab_menu']) {
return;
}
$this->loaded['tab_menu'] = true;
$menu = $this->menuFactory->createItem('root');
$menu->setChildrenAttribute('class','nav navbar-nav');
if (method_exists($menu,'setCurrentUri')) {
$menu->setCurrentUri($this->getRequest()->getBaseUrl().$this->getRequest()->getPathInfo());
}
$this->configureTabMenu($menu, $action, $childAdmin);
foreach ($this->getExtensions() as $extension) {
$extension->configureTabMenu($this, $menu, $action, $childAdmin);
}
$this->menu = $menu;
}
public function buildSideMenu($action, AdminInterface $childAdmin = null)
{
return $this->buildTabMenu($action, $childAdmin);
}
public function getSideMenu($action, AdminInterface $childAdmin = null)
{
if ($this->isChild()) {
return $this->getParent()->getSideMenu($action, $this);
}
$this->buildSideMenu($action, $childAdmin);
return $this->menu;
}
public function getRootCode()
{
return $this->getRoot()->getCode();
}
public function getRoot()
{
$parentFieldDescription = $this->getParentFieldDescription();
if (!$parentFieldDescription) {
return $this;
}
return $parentFieldDescription->getAdmin()->getRoot();
}
public function setBaseControllerName($baseControllerName)
{
$this->baseControllerName = $baseControllerName;
}
public function getBaseControllerName()
{
return $this->baseControllerName;
}
public function setLabel($label)
{
$this->label = $label;
}
public function getLabel()
{
return $this->label;
}
public function setPersistFilters($persist)
{
$this->persistFilters = $persist;
}
public function setMaxPerPage($maxPerPage)
{
$this->maxPerPage = $maxPerPage;
}
public function getMaxPerPage()
{
return $this->maxPerPage;
}
public function setMaxPageLinks($maxPageLinks)
{
$this->maxPageLinks = $maxPageLinks;
}
public function getMaxPageLinks()
{
return $this->maxPageLinks;
}
public function getFormGroups()
{
return $this->formGroups;
}
public function setFormGroups(array $formGroups)
{
$this->formGroups = $formGroups;
}
public function removeFieldFromFormGroup($key)
{
foreach ($this->formGroups as $name => $formGroup) {
unset($this->formGroups[$name]['fields'][$key]);
if (empty($this->formGroups[$name]['fields'])) {
unset($this->formGroups[$name]);
}
}
}
public function reorderFormGroup($group, array $keys)
{
$formGroups = $this->getFormGroups();
$formGroups[$group]['fields'] = array_merge(array_flip($keys), $formGroups[$group]['fields']);
$this->setFormGroups($formGroups);
}
public function getFormTabs()
{
return $this->formTabs;
}
public function setFormTabs(array $formTabs)
{
$this->formTabs = $formTabs;
}
public function getShowTabs()
{
return $this->showTabs;
}
public function setShowTabs(array $showTabs)
{
$this->showTabs = $showTabs;
}
public function getShowGroups()
{
return $this->showGroups;
}
public function setShowGroups(array $showGroups)
{
$this->showGroups = $showGroups;
}
public function reorderShowGroup($group, array $keys)
{
$showGroups = $this->getShowGroups();
$showGroups[$group]['fields'] = array_merge(array_flip($keys), $showGroups[$group]['fields']);
$this->setShowGroups($showGroups);
}
public function setParentFieldDescription(FieldDescriptionInterface $parentFieldDescription)
{
$this->parentFieldDescription = $parentFieldDescription;
}
public function getParentFieldDescription()
{
return $this->parentFieldDescription;
}
public function hasParentFieldDescription()
{
return $this->parentFieldDescription instanceof FieldDescriptionInterface;
}
public function setSubject($subject)
{
$this->subject = $subject;
}
public function getSubject()
{
if ($this->subject === null && $this->request) {
$id = $this->request->get($this->getIdParameter());
if (!preg_match('#^[0-9A-Fa-f]+$#', $id)) {
$this->subject = false;
} else {
$this->subject = $this->getModelManager()->find($this->class, $id);
}
}
return $this->subject;
}
public function hasSubject()
{
return $this->subject != null;
}
public function getFormFieldDescriptions()
{
$this->buildForm();
return $this->formFieldDescriptions;
}
public function getFormFieldDescription($name)
{
return $this->hasFormFieldDescription($name) ? $this->formFieldDescriptions[$name] : null;
}
public function hasFormFieldDescription($name)
{
return array_key_exists($name, $this->formFieldDescriptions) ? true : false;
}
public function addFormFieldDescription($name, FieldDescriptionInterface $fieldDescription)
{
$this->formFieldDescriptions[$name] = $fieldDescription;
}
public function removeFormFieldDescription($name)
{
unset($this->formFieldDescriptions[$name]);
}
public function getShowFieldDescriptions()
{
$this->buildShow();
return $this->showFieldDescriptions;
}
public function getShowFieldDescription($name)
{
$this->buildShow();
return $this->hasShowFieldDescription($name) ? $this->showFieldDescriptions[$name] : null;
}
public function hasShowFieldDescription($name)
{
return array_key_exists($name, $this->showFieldDescriptions);
}
public function addShowFieldDescription($name, FieldDescriptionInterface $fieldDescription)
{
$this->showFieldDescriptions[$name] = $fieldDescription;
}
public function removeShowFieldDescription($name)
{
unset($this->showFieldDescriptions[$name]);
}
public function getListFieldDescriptions()
{
$this->buildList();
return $this->listFieldDescriptions;
}
public function getListFieldDescription($name)
{
return $this->hasListFieldDescription($name) ? $this->listFieldDescriptions[$name] : null;
}
public function hasListFieldDescription($name)
{
$this->buildList();
return array_key_exists($name, $this->listFieldDescriptions) ? true : false;
}
public function addListFieldDescription($name, FieldDescriptionInterface $fieldDescription)
{
$this->listFieldDescriptions[$name] = $fieldDescription;
}
public function removeListFieldDescription($name)
{
unset($this->listFieldDescriptions[$name]);
}
public function getFilterFieldDescription($name)
{
return $this->hasFilterFieldDescription($name) ? $this->filterFieldDescriptions[$name] : null;
}
public function hasFilterFieldDescription($name)
{
return array_key_exists($name, $this->filterFieldDescriptions) ? true : false;
}
public function addFilterFieldDescription($name, FieldDescriptionInterface $fieldDescription)
{
$this->filterFieldDescriptions[$name] = $fieldDescription;
}
public function removeFilterFieldDescription($name)
{
unset($this->filterFieldDescriptions[$name]);
}
public function getFilterFieldDescriptions()
{
$this->buildDatagrid();
return $this->filterFieldDescriptions;
}
public function addChild(AdminInterface $child)
{
$this->children[$child->getCode()] = $child;
$child->setBaseCodeRoute($this->getCode().'|'.$child->getCode());
$child->setParent($this);
}
public function hasChild($code)
{
return isset($this->children[$code]);
}
public function getChildren()
{
return $this->children;
}
public function getChild($code)
{
return $this->hasChild($code) ? $this->children[$code] : null;
}
public function setParent(AdminInterface $parent)
{
$this->parent = $parent;
}
public function getParent()
{
return $this->parent;
}
public function isChild()
{
return $this->parent instanceof AdminInterface;
}
public function hasChildren()
{
return count($this->children) > 0;
}
public function setUniqid($uniqid)
{
$this->uniqid = $uniqid;
}
public function getUniqid()
{
if (!$this->uniqid) {
$this->uniqid ='s'.uniqid();
}
return $this->uniqid;
}
public function getClassnameLabel()
{
return $this->classnameLabel;
}
public function getPersistentParameters()
{
$parameters = array();
foreach ($this->getExtensions() as $extension) {
$params = $extension->getPersistentParameters($this);
if (!is_array($params)) {
throw new \RuntimeException(sprintf('The %s::getPersistentParameters must return an array', get_class($extension)));
}
$parameters = array_merge($parameters, $params);
}
return $parameters;
}
public function getPersistentParameter($name)
{
$parameters = $this->getPersistentParameters();
return isset($parameters[$name]) ? $parameters[$name] : null;
}
public function getBreadcrumbs($action)
{
if ($this->isChild()) {
return $this->getParent()->getBreadcrumbs($action);
}
$menu = $this->buildBreadcrumbs($action);
do {
$breadcrumbs[] = $menu;
} while ($menu = $menu->getParent());
$breadcrumbs = array_reverse($breadcrumbs);
array_shift($breadcrumbs);
return $breadcrumbs;
}
public function buildBreadcrumbs($action, MenuItemInterface $menu = null)
{
if (isset($this->breadcrumbs[$action])) {
return $this->breadcrumbs[$action];
}
if (!$menu) {
$menu = $this->menuFactory->createItem('root');
$menu = $menu->addChild(
$this->trans($this->getLabelTranslatorStrategy()->getLabel('dashboard','breadcrumb','link'), array(),'SonataAdminBundle'),
array('uri'=> $this->routeGenerator->generate('sonata_admin_dashboard'))
);
}
$menu = $menu->addChild(
$this->trans($this->getLabelTranslatorStrategy()->getLabel(sprintf('%s_list', $this->getClassnameLabel()),'breadcrumb','link')),
array('uri'=> $this->hasRoute('list') && $this->isGranted('LIST') ? $this->generateUrl('list') : null)
);
$childAdmin = $this->getCurrentChildAdmin();
if ($childAdmin) {
$id = $this->request->get($this->getIdParameter());
$menu = $menu->addChild(
$this->toString($this->getSubject()),
array('uri'=> $this->hasRoute('edit') && $this->isGranted('EDIT') ? $this->generateUrl('edit', array('id'=> $id)) : null)
);
return $childAdmin->buildBreadcrumbs($action, $menu);
} elseif ($this->isChild()) {
if ($action =='list') {
$menu->setUri(false);
} elseif ($action !='create'&& $this->hasSubject()) {
$menu = $menu->addChild($this->toString($this->getSubject()));
} else {
$menu = $menu->addChild(
$this->trans($this->getLabelTranslatorStrategy()->getLabel(sprintf('%s_%s', $this->getClassnameLabel(), $action),'breadcrumb','link'))
);
}
} elseif ($action !='list'&& $this->hasSubject()) {
$menu = $menu->addChild($this->toString($this->getSubject()));
} elseif ($action !='list') {
$menu = $menu->addChild(
$this->trans($this->getLabelTranslatorStrategy()->getLabel(sprintf('%s_%s', $this->getClassnameLabel(), $action),'breadcrumb','link'))
);
}
return $this->breadcrumbs[$action] = $menu;
}
public function setCurrentChild($currentChild)
{
$this->currentChild = $currentChild;
}
public function getCurrentChild()
{
return $this->currentChild;
}
public function getCurrentChildAdmin()
{
foreach ($this->children as $children) {
if ($children->getCurrentChild()) {
return $children;
}
}
return;
}
public function trans($id, array $parameters = array(), $domain = null, $locale = null)
{
$domain = $domain ?: $this->getTranslationDomain();
if (!$this->translator) {
return $id;
}
return $this->translator->trans($id, $parameters, $domain, $locale);
}
public function transChoice($id, $count, array $parameters = array(), $domain = null, $locale = null)
{
$domain = $domain ?: $this->getTranslationDomain();
if (!$this->translator) {
return $id;
}
return $this->translator->transChoice($id, $count, $parameters, $domain, $locale);
}
public function setTranslationDomain($translationDomain)
{
$this->translationDomain = $translationDomain;
}
public function getTranslationDomain()
{
return $this->translationDomain;
}
public function setTranslator(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function getTranslator()
{
return $this->translator;
}
public function getTranslationLabel($label, $context ='', $type ='')
{
return $this->getLabelTranslatorStrategy()->getLabel($label, $context, $type);
}
public function setRequest(Request $request)
{
$this->request = $request;
foreach ($this->getChildren() as $children) {
$children->setRequest($request);
}
}
public function getRequest()
{
if (!$this->request) {
throw new \RuntimeException('The Request object has not been set');
}
return $this->request;
}
public function hasRequest()
{
return $this->request !== null;
}
public function setFormContractor(FormContractorInterface $formBuilder)
{
$this->formContractor = $formBuilder;
}
public function getFormContractor()
{
return $this->formContractor;
}
public function setDatagridBuilder(DatagridBuilderInterface $datagridBuilder)
{
$this->datagridBuilder = $datagridBuilder;
}
public function getDatagridBuilder()
{
return $this->datagridBuilder;
}
public function setListBuilder(ListBuilderInterface $listBuilder)
{
$this->listBuilder = $listBuilder;
}
public function getListBuilder()
{
return $this->listBuilder;
}
public function setShowBuilder(ShowBuilderInterface $showBuilder)
{
$this->showBuilder = $showBuilder;
}
public function getShowBuilder()
{
return $this->showBuilder;
}
public function setConfigurationPool(Pool $configurationPool)
{
$this->configurationPool = $configurationPool;
}
public function getConfigurationPool()
{
return $this->configurationPool;
}
public function setRouteGenerator(RouteGeneratorInterface $routeGenerator)
{
$this->routeGenerator = $routeGenerator;
}
public function getRouteGenerator()
{
return $this->routeGenerator;
}
public function getCode()
{
return $this->code;
}
public function setBaseCodeRoute($baseCodeRoute)
{
$this->baseCodeRoute = $baseCodeRoute;
}
public function getBaseCodeRoute()
{
return $this->baseCodeRoute;
}
public function getModelManager()
{
return $this->modelManager;
}
public function setModelManager(ModelManagerInterface $modelManager)
{
$this->modelManager = $modelManager;
}
public function getManagerType()
{
return $this->managerType;
}
public function setManagerType($type)
{
$this->managerType = $type;
}
public function getObjectIdentifier()
{
return $this->getCode();
}
public function setSecurityInformation(array $information)
{
$this->securityInformation = $information;
}
public function getSecurityInformation()
{
return $this->securityInformation;
}
public function getPermissionsShow($context)
{
switch ($context) {
case self::CONTEXT_DASHBOARD:
case self::CONTEXT_MENU:
default:
return array('LIST');
}
}
public function showIn($context)
{
switch ($context) {
case self::CONTEXT_DASHBOARD:
case self::CONTEXT_MENU:
default:
return $this->isGranted($this->getPermissionsShow($context));
}
}
public function createObjectSecurity($object)
{
$this->getSecurityHandler()->createObjectSecurity($this, $object);
}
public function setSecurityHandler(SecurityHandlerInterface $securityHandler)
{
$this->securityHandler = $securityHandler;
}
public function getSecurityHandler()
{
return $this->securityHandler;
}
public function isGranted($name, $object = null)
{
$key = md5(json_encode($name).($object ?'/'.spl_object_hash($object) :''));
if (!array_key_exists($key, $this->cacheIsGranted)) {
$this->cacheIsGranted[$key] = $this->securityHandler->isGranted($this, $name, $object ?: $this);
}
return $this->cacheIsGranted[$key];
}
public function getUrlsafeIdentifier($entity)
{
return $this->getModelManager()->getUrlsafeIdentifier($entity);
}
public function getNormalizedIdentifier($entity)
{
return $this->getModelManager()->getNormalizedIdentifier($entity);
}
public function id($entity)
{
return $this->getNormalizedIdentifier($entity);
}
public function setValidator(ValidatorInterface $validator)
{
$this->validator = $validator;
}
public function getValidator()
{
return $this->validator;
}
public function getShow()
{
$this->buildShow();
return $this->show;
}
public function setFormTheme(array $formTheme)
{
$this->formTheme = $formTheme;
}
public function getFormTheme()
{
return $this->formTheme;
}
public function setFilterTheme(array $filterTheme)
{
$this->filterTheme = $filterTheme;
}
public function getFilterTheme()
{
return $this->filterTheme;
}
public function addExtension(AdminExtensionInterface $extension)
{
$this->extensions[] = $extension;
}
public function getExtensions()
{
return $this->extensions;
}
public function setMenuFactory(MenuFactoryInterface $menuFactory)
{
$this->menuFactory = $menuFactory;
}
public function getMenuFactory()
{
return $this->menuFactory;
}
public function setRouteBuilder(RouteBuilderInterface $routeBuilder)
{
$this->routeBuilder = $routeBuilder;
}
public function getRouteBuilder()
{
return $this->routeBuilder;
}
public function toString($object)
{
if (!is_object($object)) {
return'';
}
if (method_exists($object,'__toString') && null !== $object->__toString()) {
return (string) $object;
}
return sprintf('%s:%s', ClassUtils::getClass($object), spl_object_hash($object));
}
public function setLabelTranslatorStrategy(LabelTranslatorStrategyInterface $labelTranslatorStrategy)
{
$this->labelTranslatorStrategy = $labelTranslatorStrategy;
}
public function getLabelTranslatorStrategy()
{
return $this->labelTranslatorStrategy;
}
public function supportsPreviewMode()
{
return $this->supportsPreviewMode;
}
public function setPerPageOptions(array $options)
{
$this->perPageOptions = $options;
}
public function getPerPageOptions()
{
return $this->perPageOptions;
}
public function determinedPerPageValue($perPage)
{
return in_array($perPage, $this->perPageOptions);
}
protected function predefinePerPageOptions()
{
array_unshift($this->perPageOptions, $this->maxPerPage);
$this->perPageOptions = array_unique($this->perPageOptions);
sort($this->perPageOptions);
}
public function isAclEnabled()
{
return $this->getSecurityHandler() instanceof AclSecurityHandlerInterface;
}
public function getObjectMetadata($object)
{
return new Metadata($this->toString($object));
}
}
}
namespace Sonata\AdminBundle\Admin
{
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
interface AdminExtensionInterface
{
public function configureFormFields(FormMapper $form);
public function configureListFields(ListMapper $list);
public function configureDatagridFilters(DatagridMapper $filter);
public function configureShowFields(ShowMapper $filter);
public function configureRoutes(AdminInterface $admin, RouteCollection $collection);
public function configureSideMenu(AdminInterface $admin, MenuItemInterface $menu, $action, AdminInterface $childAdmin = null);
public function configureTabMenu(AdminInterface $admin, MenuItemInterface $menu, $action, AdminInterface $childAdmin = null);
public function validate(AdminInterface $admin, ErrorElement $errorElement, $object);
public function configureQuery(AdminInterface $admin, ProxyQueryInterface $query, $context ='list');
public function alterNewInstance(AdminInterface $admin, $object);
public function alterObject(AdminInterface $admin, $object);
public function getPersistentParameters(AdminInterface $admin);
public function preUpdate(AdminInterface $admin, $object);
public function postUpdate(AdminInterface $admin, $object);
public function prePersist(AdminInterface $admin, $object);
public function postPersist(AdminInterface $admin, $object);
public function preRemove(AdminInterface $admin, $object);
public function postRemove(AdminInterface $admin, $object);
}
}
namespace Sonata\AdminBundle\Admin
{
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
abstract class AdminExtension implements AdminExtensionInterface
{
public function configureFormFields(FormMapper $form)
{
}
public function configureListFields(ListMapper $list)
{
}
public function configureDatagridFilters(DatagridMapper $filter)
{
}
public function configureShowFields(ShowMapper $filter)
{
}
public function configureRoutes(AdminInterface $admin, RouteCollection $collection)
{
}
public function configureSideMenu(AdminInterface $admin, MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
{
}
public function configureTabMenu(AdminInterface $admin, MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
{
$this->configureSideMenu($admin, $menu, $action, $childAdmin);
}
public function validate(AdminInterface $admin, ErrorElement $errorElement, $object)
{
}
public function configureQuery(AdminInterface $admin, ProxyQueryInterface $query, $context ='list')
{
}
public function alterNewInstance(AdminInterface $admin, $object)
{
}
public function alterObject(AdminInterface $admin, $object)
{
}
public function getPersistentParameters(AdminInterface $admin)
{
return array();
}
public function preUpdate(AdminInterface $admin, $object)
{
}
public function postUpdate(AdminInterface $admin, $object)
{
}
public function prePersist(AdminInterface $admin, $object)
{
}
public function postPersist(AdminInterface $admin, $object)
{
}
public function preRemove(AdminInterface $admin, $object)
{
}
public function postRemove(AdminInterface $admin, $object)
{
}
}
}
namespace Sonata\AdminBundle\Admin
{
use Doctrine\Common\Inflector\Inflector;
use Doctrine\Common\Util\ClassUtils;
use Sonata\AdminBundle\Exception\NoValueException;
use Sonata\AdminBundle\Util\FormBuilderIterator;
use Sonata\AdminBundle\Util\FormViewIterator;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormView;
class AdminHelper
{
protected $pool;
public function __construct(Pool $pool)
{
$this->pool = $pool;
}
public function getChildFormBuilder(FormBuilder $formBuilder, $elementId)
{
foreach (new FormBuilderIterator($formBuilder) as $name => $formBuilder) {
if ($name == $elementId) {
return $formBuilder;
}
}
return;
}
public function getChildFormView(FormView $formView, $elementId)
{
foreach (new \RecursiveIteratorIterator(new FormViewIterator($formView), \RecursiveIteratorIterator::SELF_FIRST) as $name => $formView) {
if ($name === $elementId) {
return $formView;
}
}
return;
}
public function getAdmin($code)
{
return $this->pool->getInstance($code);
}
public function appendFormFieldElement(AdminInterface $admin, $subject, $elementId)
{
$formBuilder = $admin->getFormBuilder();
$form = $formBuilder->getForm();
$form->setData($subject);
$form->submit($admin->getRequest());
$childFormBuilder = $this->getChildFormBuilder($formBuilder, $elementId);
$fieldDescription = $admin->getFormFieldDescription($childFormBuilder->getName());
try {
$value = $fieldDescription->getValue($form->getData());
} catch (NoValueException $e) {
$value = null;
}
$data = $admin->getRequest()->get($formBuilder->getName());
if (!isset($data[$childFormBuilder->getName()])) {
$data[$childFormBuilder->getName()] = array();
}
$objectCount = count($value);
$postCount = count($data[$childFormBuilder->getName()]);
$fields = array_keys($fieldDescription->getAssociationAdmin()->getFormFieldDescriptions());
$value = array();
foreach ($fields as $name) {
$value[$name] ='';
}
while ($objectCount < $postCount) {
$this->addNewInstance($form->getData(), $fieldDescription);
++$objectCount;
}
$this->addNewInstance($form->getData(), $fieldDescription);
$data[$childFormBuilder->getName()][] = $value;
$finalForm = $admin->getFormBuilder()->getForm();
$finalForm->setData($subject);
$finalForm->setData($form->getData());
return array($fieldDescription, $finalForm);
}
public function addNewInstance($object, FieldDescriptionInterface $fieldDescription)
{
$instance = $fieldDescription->getAssociationAdmin()->getNewInstance();
$mapping = $fieldDescription->getAssociationMapping();
$method = sprintf('add%s', $this->camelize($mapping['fieldName']));
if (!method_exists($object, $method)) {
$method = rtrim($method,'s');
if (!method_exists($object, $method)) {
$method = sprintf('add%s', $this->camelize(Inflector::singularize($mapping['fieldName'])));
if (!method_exists($object, $method)) {
throw new \RuntimeException(sprintf('Please add a method %s in the %s class!', $method, ClassUtils::getClass($object)));
}
}
}
$object->$method($instance);
}
public function camelize($property)
{
return BaseFieldDescription::camelize($property);
}
}
}
namespace Sonata\AdminBundle\Admin
{
interface FieldDescriptionInterface
{
public function setFieldName($fieldName);
public function getFieldName();
public function setName($name);
public function getName();
public function getOption($name, $default = null);
public function setOption($name, $value);
public function setOptions(array $options);
public function getOptions();
public function setTemplate($template);
public function getTemplate();
public function setType($type);
public function getType();
public function setParent(AdminInterface $parent);
public function getParent();
public function setAssociationMapping($associationMapping);
public function getAssociationMapping();
public function getTargetEntity();
public function setFieldMapping($fieldMapping);
public function getFieldMapping();
public function setParentAssociationMappings(array $parentAssociationMappings);
public function getParentAssociationMappings();
public function setAssociationAdmin(AdminInterface $associationAdmin);
public function getAssociationAdmin();
public function isIdentifier();
public function getValue($object);
public function setAdmin(AdminInterface $admin);
public function getAdmin();
public function mergeOption($name, array $options = array());
public function mergeOptions(array $options = array());
public function setMappingType($mappingType);
public function getMappingType();
public function getLabel();
public function getTranslationDomain();
public function isSortable();
public function getSortFieldMapping();
public function getSortParentAssociationMapping();
public function getFieldValue($object, $fieldName);
}
}
namespace Sonata\AdminBundle\Admin
{
use Sonata\AdminBundle\Exception\NoValueException;
abstract class BaseFieldDescription implements FieldDescriptionInterface
{
protected $name;
protected $type;
protected $mappingType;
protected $fieldName;
protected $associationMapping;
protected $fieldMapping;
protected $parentAssociationMappings;
protected $template;
protected $options = array();
protected $parent = null;
protected $admin;
protected $associationAdmin;
protected $help;
public function setFieldName($fieldName)
{
$this->fieldName = $fieldName;
}
public function getFieldName()
{
return $this->fieldName;
}
public function setName($name)
{
$this->name = $name;
if (!$this->getFieldName()) {
$this->setFieldName(substr(strrchr('.'.$name,'.'), 1));
}
}
public function getName()
{
return $this->name;
}
public function getOption($name, $default = null)
{
return isset($this->options[$name]) ? $this->options[$name] : $default;
}
public function setOption($name, $value)
{
$this->options[$name] = $value;
}
public function setOptions(array $options)
{
if (isset($options['type'])) {
$this->setType($options['type']);
unset($options['type']);
}
if (isset($options['template'])) {
$this->setTemplate($options['template']);
unset($options['template']);
}
if (isset($options['help'])) {
$this->setHelp($options['help']);
unset($options['help']);
}
if (!isset($options['placeholder'])) {
$options['placeholder'] ='short_object_description_placeholder';
}
if (!isset($options['link_parameters'])) {
$options['link_parameters'] = array();
}
$this->options = $options;
}
public function getOptions()
{
return $this->options;
}
public function setTemplate($template)
{
$this->template = $template;
}
public function getTemplate()
{
return $this->template;
}
public function setType($type)
{
$this->type = $type;
}
public function getType()
{
return $this->type;
}
public function setParent(AdminInterface $parent)
{
$this->parent = $parent;
}
public function getParent()
{
return $this->parent;
}
public function getAssociationMapping()
{
return $this->associationMapping;
}
public function getFieldMapping()
{
return $this->fieldMapping;
}
public function getParentAssociationMappings()
{
return $this->parentAssociationMappings;
}
public function setAssociationAdmin(AdminInterface $associationAdmin)
{
$this->associationAdmin = $associationAdmin;
$this->associationAdmin->setParentFieldDescription($this);
}
public function getAssociationAdmin()
{
return $this->associationAdmin;
}
public function hasAssociationAdmin()
{
return $this->associationAdmin !== null;
}
public function getFieldValue($object, $fieldName)
{
$camelizedFieldName = self::camelize($fieldName);
$getters = array();
$parameters = array();
if ($this->getOption('code')) {
$getters[] = $this->getOption('code');
}
if ($this->getOption('parameters')) {
$parameters = $this->getOption('parameters');
}
$getters[] ='get'.$camelizedFieldName;
$getters[] ='is'.$camelizedFieldName;
foreach ($getters as $getter) {
if (method_exists($object, $getter)) {
return call_user_func_array(array($object, $getter), $parameters);
}
}
if (isset($object->{$fieldName})) {
return $object->{$fieldName};
}
throw new NoValueException(sprintf('Unable to retrieve the value of `%s`', $this->getName()));
}
public function setAdmin(AdminInterface $admin)
{
$this->admin = $admin;
}
public function getAdmin()
{
return $this->admin;
}
public function mergeOption($name, array $options = array())
{
if (!isset($this->options[$name])) {
$this->options[$name] = array();
}
if (!is_array($this->options[$name])) {
throw new \RuntimeException(sprintf('The key `%s` does not point to an array value', $name));
}
$this->options[$name] = array_merge($this->options[$name], $options);
}
public function mergeOptions(array $options = array())
{
$this->setOptions(array_merge_recursive($this->options, $options));
}
public function setMappingType($mappingType)
{
$this->mappingType = $mappingType;
}
public function getMappingType()
{
return $this->mappingType;
}
public static function camelize($property)
{
return preg_replace_callback('/(^|[_. ])+(.)/', function ($match) {
return ('.'=== $match[1] ?'_':'').strtoupper($match[2]);
}, $property);
}
public function setHelp($help)
{
$this->help = $help;
}
public function getHelp()
{
return $this->help;
}
public function getLabel()
{
return $this->getOption('label');
}
public function isSortable()
{
return false !== $this->getOption('sortable', false);
}
public function getSortFieldMapping()
{
return $this->getOption('sort_field_mapping');
}
public function getSortParentAssociationMapping()
{
return $this->getOption('sort_parent_association_mappings');
}
public function getTranslationDomain()
{
return $this->getOption('translation_domain') ?: $this->getAdmin()->getTranslationDomain();
}
}
}
namespace Sonata\AdminBundle\Admin
{
class FieldDescriptionCollection implements \ArrayAccess, \Countable
{
protected $elements = array();
public function add(FieldDescriptionInterface $fieldDescription)
{
$this->elements[$fieldDescription->getName()] = $fieldDescription;
}
public function getElements()
{
return $this->elements;
}
public function has($name)
{
return array_key_exists($name, $this->elements);
}
public function get($name)
{
if ($this->has($name)) {
return $this->elements[$name];
}
throw new \InvalidArgumentException(sprintf('Element "%s" does not exist.', $name));
}
public function remove($name)
{
if ($this->has($name)) {
unset($this->elements[$name]);
}
}
public function offsetExists($offset)
{
return $this->has($offset);
}
public function offsetGet($offset)
{
return $this->get($offset);
}
public function offsetSet($offset, $value)
{
throw new \RunTimeException('Cannot set value, use add');
}
public function offsetUnset($offset)
{
$this->remove($offset);
}
public function count()
{
return count($this->elements);
}
public function reorder(array $keys)
{
if ($this->has('batch')) {
array_unshift($keys,'batch');
}
$this->elements = array_merge(array_flip($keys), $this->elements);
}
}
}
namespace Sonata\AdminBundle\Admin
{
use Symfony\Component\DependencyInjection\ContainerInterface;
class Pool
{
protected $container = null;
protected $adminServiceIds = array();
protected $adminGroups = array();
protected $adminClasses = array();
protected $templates = array();
protected $assets = array();
protected $title;
protected $titleLogo;
protected $options;
public function __construct(ContainerInterface $container, $title, $logoTitle, $options = array())
{
$this->container = $container;
$this->title = $title;
$this->titleLogo = $logoTitle;
$this->options = $options;
}
public function getGroups()
{
$groups = $this->adminGroups;
foreach ($this->adminGroups as $name => $adminGroup) {
foreach ($adminGroup as $id => $options) {
$groups[$name][$id] = $this->getInstance($id);
}
}
return $groups;
}
public function hasGroup($group)
{
return isset($this->adminGroups[$group]);
}
public function getDashboardGroups()
{
$groups = $this->adminGroups;
foreach ($this->adminGroups as $name => $adminGroup) {
if (isset($adminGroup['items'])) {
foreach ($adminGroup['items'] as $key => $id) {
$admin = $this->getInstance($id);
if ($admin->showIn(Admin::CONTEXT_DASHBOARD)) {
$groups[$name]['items'][$key] = $admin;
} else {
unset($groups[$name]['items'][$key]);
}
}
}
if (empty($groups[$name]['items'])) {
unset($groups[$name]);
}
}
return $groups;
}
public function getAdminsByGroup($group)
{
if (!isset($this->adminGroups[$group])) {
throw new \InvalidArgumentException(sprintf('Group "%s" not found in admin pool.', $group));
}
$admins = array();
if (!isset($this->adminGroups[$group]['items'])) {
return $admins;
}
foreach ($this->adminGroups[$group]['items'] as $id) {
$admins[] = $this->getInstance($id);
}
return $admins;
}
public function getAdminByClass($class)
{
if (!$this->hasAdminByClass($class)) {
return;
}
if (!is_array($this->adminClasses[$class])) {
throw new \RuntimeException('Invalid format for the Pool::adminClass property');
}
if (count($this->adminClasses[$class]) > 1) {
throw new \RuntimeException(sprintf('Unable to found a valid admin for the class: %s, get too many admin registered: %s', $class, implode(',', $this->adminClasses[$class])));
}
return $this->getInstance($this->adminClasses[$class][0]);
}
public function hasAdminByClass($class)
{
return isset($this->adminClasses[$class]);
}
public function getAdminByAdminCode($adminCode)
{
$codes = explode('|', $adminCode);
$admin = false;
foreach ($codes as $code) {
if ($admin == false) {
$admin = $this->getInstance($code);
} elseif ($admin->hasChild($code)) {
$admin = $admin->getChild($code);
}
}
return $admin;
}
public function getInstance($id)
{
if (!in_array($id, $this->adminServiceIds)) {
throw new \InvalidArgumentException(sprintf('Admin service "%s" not found in admin pool.', $id));
}
return $this->container->get($id);
}
public function getContainer()
{
return $this->container;
}
public function setAdminGroups(array $adminGroups)
{
$this->adminGroups = $adminGroups;
}
public function getAdminGroups()
{
return $this->adminGroups;
}
public function setAdminServiceIds(array $adminServiceIds)
{
$this->adminServiceIds = $adminServiceIds;
}
public function getAdminServiceIds()
{
return $this->adminServiceIds;
}
public function setAdminClasses(array $adminClasses)
{
$this->adminClasses = $adminClasses;
}
public function getAdminClasses()
{
return $this->adminClasses;
}
public function setTemplates(array $templates)
{
$this->templates = $templates;
}
public function getTemplates()
{
return $this->templates;
}
public function getTemplate($name)
{
if (isset($this->templates[$name])) {
return $this->templates[$name];
}
return;
}
public function getTitleLogo()
{
return $this->titleLogo;
}
public function getTitle()
{
return $this->title;
}
public function getOption($name, $default = null)
{
if (isset($this->options[$name])) {
return $this->options[$name];
}
return $default;
}
}
}
namespace Sonata\AdminBundle\Block
{
use Sonata\AdminBundle\Admin\Pool;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class AdminListBlockService extends BaseBlockService
{
protected $pool;
public function __construct($name, EngineInterface $templating, Pool $pool)
{
parent::__construct($name, $templating);
$this->pool = $pool;
}
public function execute(BlockContextInterface $blockContext, Response $response = null)
{
$dashboardGroups = $this->pool->getDashboardGroups();
$settings = $blockContext->getSettings();
$visibleGroups = array();
foreach ($dashboardGroups as $name => $dashboardGroup) {
if (!$settings['groups'] || in_array($name, $settings['groups'])) {
$visibleGroups[] = $dashboardGroup;
}
}
return $this->renderPrivateResponse($this->pool->getTemplate('list_block'), array('block'=> $blockContext->getBlock(),'settings'=> $settings,'admin_pool'=> $this->pool,'groups'=> $visibleGroups,
), $response);
}
public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
{
}
public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
{
}
public function getName()
{
return'Admin List';
}
public function setDefaultSettings(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('groups'=> false,
));
$resolver->setAllowedTypes(array('groups'=> array('bool','array'),
));
}
}
}
namespace Sonata\AdminBundle\Builder
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
interface BuilderInterface
{
public function fixFieldDescription(AdminInterface $admin, FieldDescriptionInterface $fieldDescription);
}
}
namespace Sonata\AdminBundle\Builder
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Sonata\AdminBundle\Datagrid\DatagridInterface;
interface DatagridBuilderInterface extends BuilderInterface
{
public function addFilter(DatagridInterface $datagrid, $type = null, FieldDescriptionInterface $fieldDescription, AdminInterface $admin);
public function getBaseDatagrid(AdminInterface $admin, array $values = array());
}
}
namespace Sonata\AdminBundle\Builder
{
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormFactoryInterface;
interface FormContractorInterface extends BuilderInterface
{
public function __construct(FormFactoryInterface $formFactory);
public function getFormBuilder($name, array $options = array());
public function getDefaultOptions($type, FieldDescriptionInterface $fieldDescription);
}
}
namespace Sonata\AdminBundle\Builder
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Admin\FieldDescriptionCollection;
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
interface ListBuilderInterface extends BuilderInterface
{
public function getBaseList(array $options = array());
public function buildField($type = null, FieldDescriptionInterface $fieldDescription, AdminInterface $admin);
public function addField(FieldDescriptionCollection $list, $type = null, FieldDescriptionInterface $fieldDescription, AdminInterface $admin);
}
}
namespace Sonata\AdminBundle\Builder
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Route\RouteCollection;
interface RouteBuilderInterface
{
public function build(AdminInterface $admin, RouteCollection $collection);
}
}
namespace Sonata\AdminBundle\Builder
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Admin\FieldDescriptionCollection;
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
interface ShowBuilderInterface extends BuilderInterface
{
public function getBaseList(array $options = array());
public function addField(FieldDescriptionCollection $list, $type = null, FieldDescriptionInterface $fieldDescription, AdminInterface $admin);
}
}
namespace Sonata\AdminBundle\Datagrid
{
use Sonata\AdminBundle\Filter\FilterInterface;
interface DatagridInterface
{
public function getPager();
public function getQuery();
public function getResults();
public function buildPager();
public function addFilter(FilterInterface $filter);
public function getFilters();
public function reorderFilters(array $keys);
public function getValues();
public function getColumns();
public function setValue($name, $operator, $value);
public function getForm();
public function getFilter($name);
public function hasFilter($name);
public function removeFilter($name);
public function hasActiveFilters();
}
}
namespace Sonata\AdminBundle\Datagrid
{
use Sonata\AdminBundle\Admin\FieldDescriptionCollection;
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Sonata\AdminBundle\Filter\FilterInterface;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\FormBuilder;
class Datagrid implements DatagridInterface
{
protected $filters = array();
protected $values;
protected $columns;
protected $pager;
protected $bound = false;
protected $query;
protected $formBuilder;
protected $form;
protected $results;
public function __construct(ProxyQueryInterface $query, FieldDescriptionCollection $columns, PagerInterface $pager, FormBuilder $formBuilder, array $values = array())
{
$this->pager = $pager;
$this->query = $query;
$this->values = $values;
$this->columns = $columns;
$this->formBuilder = $formBuilder;
}
public function getPager()
{
return $this->pager;
}
public function getResults()
{
$this->buildPager();
if (!$this->results) {
$this->results = $this->pager->getResults();
}
return $this->results;
}
public function buildPager()
{
if ($this->bound) {
return;
}
foreach ($this->getFilters() as $name => $filter) {
list($type, $options) = $filter->getRenderSettings();
$this->formBuilder->add($filter->getFormName(), $type, $options);
}
$this->formBuilder->add('_sort_by','hidden');
$this->formBuilder->get('_sort_by')->addViewTransformer(new CallbackTransformer(
function ($value) { return $value; },
function ($value) { return $value instanceof FieldDescriptionInterface ? $value->getName() : $value; }
));
$this->formBuilder->add('_sort_order','hidden');
$this->formBuilder->add('_page','hidden');
$this->formBuilder->add('_per_page','hidden');
$this->form = $this->formBuilder->getForm();
$this->form->submit($this->values);
$data = $this->form->getData();
foreach ($this->getFilters() as $name => $filter) {
$this->values[$name] = isset($this->values[$name]) ? $this->values[$name] : null;
$filter->apply($this->query, $data[$filter->getFormName()]);
}
if (isset($this->values['_sort_by'])) {
if (!$this->values['_sort_by'] instanceof FieldDescriptionInterface) {
throw new UnexpectedTypeException($this->values['_sort_by'],'FieldDescriptionInterface');
}
if ($this->values['_sort_by']->isSortable()) {
$this->query->setSortBy($this->values['_sort_by']->getSortParentAssociationMapping(), $this->values['_sort_by']->getSortFieldMapping());
$this->query->setSortOrder(isset($this->values['_sort_order']) ? $this->values['_sort_order'] : null);
}
}
$maxPerPage = 25;
if (isset($this->values['_per_page'])) {
if (is_array($this->values['_per_page'])) {
if (isset($this->values['_per_page']['value'])) {
$maxPerPage = $this->values['_per_page']['value'];
}
} else {
$maxPerPage = $this->values['_per_page'];
}
}
$this->pager->setMaxPerPage($maxPerPage);
$page = 1;
if (isset($this->values['_page'])) {
if (is_array($this->values['_page'])) {
if (isset($this->values['_page']['value'])) {
$page = $this->values['_page']['value'];
}
} else {
$page = $this->values['_page'];
}
}
$this->pager->setPage($page);
$this->pager->setQuery($this->query);
$this->pager->init();
$this->bound = true;
}
public function addFilter(FilterInterface $filter)
{
$this->filters[$filter->getName()] = $filter;
}
public function hasFilter($name)
{
return isset($this->filters[$name]);
}
public function removeFilter($name)
{
unset($this->filters[$name]);
}
public function getFilter($name)
{
return $this->hasFilter($name) ? $this->filters[$name] : null;
}
public function getFilters()
{
return $this->filters;
}
public function reorderFilters(array $keys)
{
$this->filters = array_merge(array_flip($keys), $this->filters);
}
public function getValues()
{
return $this->values;
}
public function setValue($name, $operator, $value)
{
$this->values[$name] = array('type'=> $operator,'value'=> $value,
);
}
public function hasActiveFilters()
{
foreach ($this->filters as $name => $filter) {
if ($filter->isActive()) {
return true;
}
}
return false;
}
public function getColumns()
{
return $this->columns;
}
public function getQuery()
{
return $this->query;
}
public function getForm()
{
$this->buildPager();
return $this->form;
}
}
}
namespace Sonata\AdminBundle\Mapper
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Builder\BuilderInterface;
abstract class BaseMapper
{
protected $admin;
protected $builder;
public function __construct(BuilderInterface $builder, AdminInterface $admin)
{
$this->builder = $builder;
$this->admin = $admin;
}
public function getAdmin()
{
return $this->admin;
}
abstract public function get($key);
abstract public function has($key);
abstract public function remove($key);
abstract public function reorder(array $keys);
}
}
namespace Sonata\AdminBundle\Datagrid
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Sonata\AdminBundle\Builder\DatagridBuilderInterface;
use Sonata\AdminBundle\Mapper\BaseMapper;
class DatagridMapper extends BaseMapper
{
protected $datagrid;
public function __construct(DatagridBuilderInterface $datagridBuilder, DatagridInterface $datagrid, AdminInterface $admin)
{
parent::__construct($datagridBuilder, $admin);
$this->datagrid = $datagrid;
}
public function add($name, $type = null, array $filterOptions = array(), $fieldType = null, $fieldOptions = null)
{
if (is_array($fieldOptions)) {
$filterOptions['field_options'] = $fieldOptions;
}
if ($fieldType) {
$filterOptions['field_type'] = $fieldType;
}
$filterOptions['field_name'] = isset($filterOptions['field_name']) ? $filterOptions['field_name'] : substr(strrchr('.'.$name,'.'), 1);
if ($name instanceof FieldDescriptionInterface) {
$fieldDescription = $name;
$fieldDescription->mergeOptions($filterOptions);
} elseif (is_string($name) && !$this->admin->hasFilterFieldDescription($name)) {
$fieldDescription = $this->admin->getModelManager()->getNewFieldDescriptionInstance(
$this->admin->getClass(),
$name,
$filterOptions
);
} elseif (is_string($name) && $this->admin->hasFilterFieldDescription($name)) {
throw new \RuntimeException(sprintf('The field "%s" is already defined', $name));
} else {
throw new \RuntimeException('invalid state');
}
$this->builder->addFilter($this->datagrid, $type, $fieldDescription, $this->admin);
return $this;
}
public function get($name)
{
return $this->datagrid->getFilter($name);
}
public function has($key)
{
return $this->datagrid->hasFilter($key);
}
public function remove($key)
{
$this->admin->removeFilterFieldDescription($key);
$this->datagrid->removeFilter($key);
return $this;
}
public function reorder(array $keys)
{
$this->datagrid->reorderFilters($keys);
return $this;
}
}
}
namespace Sonata\AdminBundle\Datagrid
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Admin\FieldDescriptionCollection;
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Sonata\AdminBundle\Builder\ListBuilderInterface;
use Sonata\AdminBundle\Mapper\BaseMapper;
class ListMapper extends BaseMapper
{
protected $list;
public function __construct(ListBuilderInterface $listBuilder, FieldDescriptionCollection $list, AdminInterface $admin)
{
parent::__construct($listBuilder, $admin);
$this->list = $list;
}
public function addIdentifier($name, $type = null, array $fieldDescriptionOptions = array())
{
$fieldDescriptionOptions['identifier'] = true;
if (!isset($fieldDescriptionOptions['route']['name'])) {
$routeName = $this->admin->isGranted('EDIT') ?'edit':'show';
$fieldDescriptionOptions['route']['name'] = $routeName;
}
if (!isset($fieldDescriptionOptions['route']['parameters'])) {
$fieldDescriptionOptions['route']['parameters'] = array();
}
return $this->add($name, $type, $fieldDescriptionOptions);
}
public function add($name, $type = null, array $fieldDescriptionOptions = array())
{
if ($name =='_action'&& $type =='actions') {
if (isset($fieldDescriptionOptions['actions']['view'])) {
@trigger_error('Inline action "view" is deprecated since version 2.2.4 and will be removed in 3.0. Use inline action "show" instead.', E_USER_DEPRECATED);
$fieldDescriptionOptions['actions']['show'] = $fieldDescriptionOptions['actions']['view'];
unset($fieldDescriptionOptions['actions']['view']);
}
}
if ($name instanceof FieldDescriptionInterface) {
$fieldDescription = $name;
$fieldDescription->mergeOptions($fieldDescriptionOptions);
} elseif (is_string($name)) {
if ($this->admin->hasListFieldDescription($name)) {
throw new \RuntimeException(sprintf('Duplicate field name "%s" in list mapper. Names should be unique.', $name));
}
$fieldDescription = $this->admin->getModelManager()->getNewFieldDescriptionInstance(
$this->admin->getClass(),
$name,
$fieldDescriptionOptions
);
} else {
throw new \RuntimeException('Unknown field name in list mapper. Field name should be either of FieldDescriptionInterface interface or string.');
}
if (!$fieldDescription->getLabel()) {
$fieldDescription->setOption('label', $this->admin->getLabelTranslatorStrategy()->getLabel($fieldDescription->getName(),'list','label'));
}
$this->builder->addField($this->list, $type, $fieldDescription, $this->admin);
return $this;
}
public function get($name)
{
return $this->list->get($name);
}
public function has($key)
{
return $this->list->has($key);
}
public function remove($key)
{
$this->admin->removeListFieldDescription($key);
$this->list->remove($key);
return $this;
}
public function reorder(array $keys)
{
$this->list->reorder($keys);
return $this;
}
}
}
namespace Sonata\AdminBundle\Datagrid
{
interface PagerInterface
{
public function init();
public function getMaxPerPage();
public function setMaxPerPage($max);
public function setPage($page);
public function setQuery($query);
public function getResults();
}
}
namespace Sonata\AdminBundle\Datagrid
{
abstract class Pager implements \Iterator, \Countable, \Serializable, PagerInterface
{
protected $page = 1;
protected $maxPerPage = 0;
protected $lastPage = 1;
protected $nbResults = 0;
protected $cursor = 1;
protected $parameters = array();
protected $currentMaxLink = 1;
protected $maxRecordLimit = false;
protected $maxPageLinks = 0;
protected $results = null;
protected $resultsCounter = 0;
protected $query = null;
protected $countColumn = array('id');
public function __construct($maxPerPage = 10)
{
$this->setMaxPerPage($maxPerPage);
}
public function getCurrentMaxLink()
{
return $this->currentMaxLink;
}
public function getMaxRecordLimit()
{
return $this->maxRecordLimit;
}
public function setMaxRecordLimit($limit)
{
$this->maxRecordLimit = $limit;
}
public function getLinks($nbLinks = null)
{
if ($nbLinks == null) {
$nbLinks = $this->getMaxPageLinks();
}
$links = array();
$tmp = $this->page - floor($nbLinks / 2);
$check = $this->lastPage - $nbLinks + 1;
$limit = $check > 0 ? $check : 1;
$begin = $tmp > 0 ? ($tmp > $limit ? $limit : $tmp) : 1;
$i = (int) $begin;
while ($i < $begin + $nbLinks && $i <= $this->lastPage) {
$links[] = $i++;
}
$this->currentMaxLink = count($links) ? $links[count($links) - 1] : 1;
return $links;
}
public function haveToPaginate()
{
return $this->getMaxPerPage() && $this->getNbResults() > $this->getMaxPerPage();
}
public function getCursor()
{
return $this->cursor;
}
public function setCursor($pos)
{
if ($pos < 1) {
$this->cursor = 1;
} else {
if ($pos > $this->nbResults) {
$this->cursor = $this->nbResults;
} else {
$this->cursor = $pos;
}
}
}
public function getObjectByCursor($pos)
{
$this->setCursor($pos);
return $this->getCurrent();
}
public function getCurrent()
{
return $this->retrieveObject($this->cursor);
}
public function getNext()
{
if ($this->cursor + 1 > $this->nbResults) {
return;
} else {
return $this->retrieveObject($this->cursor + 1);
}
}
public function getPrevious()
{
if ($this->cursor - 1 < 1) {
return;
} else {
return $this->retrieveObject($this->cursor - 1);
}
}
public function getFirstIndice()
{
if ($this->page == 0) {
return 1;
} else {
return ($this->page - 1) * $this->maxPerPage + 1;
}
}
public function getLastIndice()
{
if ($this->page == 0) {
return $this->nbResults;
} else {
if ($this->page * $this->maxPerPage >= $this->nbResults) {
return $this->nbResults;
} else {
return $this->page * $this->maxPerPage;
}
}
}
public function getNbResults()
{
return $this->nbResults;
}
protected function setNbResults($nb)
{
$this->nbResults = $nb;
}
public function getFirstPage()
{
return 1;
}
public function getLastPage()
{
return $this->lastPage;
}
protected function setLastPage($page)
{
$this->lastPage = $page;
if ($this->getPage() > $page) {
$this->setPage($page);
}
}
public function getPage()
{
return $this->page;
}
public function getNextPage()
{
return min($this->getPage() + 1, $this->getLastPage());
}
public function getPreviousPage()
{
return max($this->getPage() - 1, $this->getFirstPage());
}
public function setPage($page)
{
$this->page = intval($page);
if ($this->page <= 0) {
$this->page = $this->getMaxPerPage() ? 1 : 0;
}
}
public function getMaxPerPage()
{
return $this->maxPerPage;
}
public function setMaxPerPage($max)
{
if ($max > 0) {
$this->maxPerPage = $max;
if ($this->page == 0) {
$this->page = 1;
}
} else {
if ($max == 0) {
$this->maxPerPage = 0;
$this->page = 0;
} else {
$this->maxPerPage = 1;
if ($this->page == 0) {
$this->page = 1;
}
}
}
}
public function getMaxPageLinks()
{
return $this->maxPageLinks;
}
public function setMaxPageLinks($maxPageLinks)
{
$this->maxPageLinks = $maxPageLinks;
}
public function isFirstPage()
{
return 1 == $this->page;
}
public function isLastPage()
{
return $this->page == $this->lastPage;
}
public function getParameters()
{
return $this->parameters;
}
public function getParameter($name, $default = null)
{
return isset($this->parameters[$name]) ? $this->parameters[$name] : $default;
}
public function hasParameter($name)
{
return isset($this->parameters[$name]);
}
public function setParameter($name, $value)
{
$this->parameters[$name] = $value;
}
protected function isIteratorInitialized()
{
return null !== $this->results;
}
protected function initializeIterator()
{
$this->results = $this->getResults();
$this->resultsCounter = count($this->results);
}
protected function resetIterator()
{
$this->results = null;
$this->resultsCounter = 0;
}
public function current()
{
if (!$this->isIteratorInitialized()) {
$this->initializeIterator();
}
return current($this->results);
}
public function key()
{
if (!$this->isIteratorInitialized()) {
$this->initializeIterator();
}
return key($this->results);
}
public function next()
{
if (!$this->isIteratorInitialized()) {
$this->initializeIterator();
}
--$this->resultsCounter;
return next($this->results);
}
public function rewind()
{
if (!$this->isIteratorInitialized()) {
$this->initializeIterator();
}
$this->resultsCounter = count($this->results);
return reset($this->results);
}
public function valid()
{
if (!$this->isIteratorInitialized()) {
$this->initializeIterator();
}
return $this->resultsCounter > 0;
}
public function count()
{
return $this->getNbResults();
}
public function serialize()
{
$vars = get_object_vars($this);
unset($vars['query']);
return serialize($vars);
}
public function unserialize($serialized)
{
$array = unserialize($serialized);
foreach ($array as $name => $values) {
$this->$name = $values;
}
}
public function getCountColumn()
{
return $this->countColumn;
}
public function setCountColumn(array $countColumn)
{
return $this->countColumn = $countColumn;
}
protected function retrieveObject($offset)
{
$queryForRetrieve = clone $this->getQuery();
$queryForRetrieve
->setFirstResult($offset - 1)
->setMaxResults(1);
$results = $queryForRetrieve->execute();
return $results[0];
}
public function setQuery($query)
{
$this->query = $query;
}
public function getQuery()
{
return $this->query;
}
}
}
namespace Sonata\AdminBundle\Datagrid
{
interface ProxyQueryInterface
{
public function execute(array $params = array(), $hydrationMode = null);
public function __call($name, $args);
public function setSortBy($parentAssociationMappings, $fieldMapping);
public function getSortBy();
public function setSortOrder($sortOrder);
public function getSortOrder();
public function getSingleScalarResult();
public function setFirstResult($firstResult);
public function getFirstResult();
public function setMaxResults($maxResults);
public function getMaxResults();
public function getUniqueParameterId();
public function entityJoin(array $associationMappings);
}
}
namespace Sonata\AdminBundle\Exception
{
class ModelManagerException extends \Exception
{
}
}
namespace Sonata\AdminBundle\Exception
{
class NoValueException extends \Exception
{
}
}
namespace Sonata\CoreBundle\Exporter
{
use Exporter\Source\SourceIteratorInterface;
use Exporter\Writer\CsvWriter;
use Exporter\Writer\JsonWriter;
use Exporter\Writer\XlsWriter;
use Exporter\Writer\XmlWriter;
use Symfony\Component\HttpFoundation\StreamedResponse;
class Exporter
{
public function getResponse($format, $filename, SourceIteratorInterface $source)
{
switch ($format) {
case'xls':
$writer = new XlsWriter('php://output');
$contentType ='application/vnd.ms-excel';
break;
case'xml':
$writer = new XmlWriter('php://output');
$contentType ='text/xml';
break;
case'json':
$writer = new JsonWriter('php://output');
$contentType ='application/json';
break;
case'csv':
$writer = new CsvWriter('php://output',',','"','', true, true);
$contentType ='text/csv';
break;
default:
throw new \RuntimeException('Invalid format');
}
$callback = function () use ($source, $writer) {
$handler = \Exporter\Handler::create($source, $writer);
$handler->export();
};
return new StreamedResponse($callback, 200, array('Content-Type'=> $contentType,'Content-Disposition'=> sprintf('attachment; filename="%s"', $filename),
));
}
}
}
namespace Sonata\AdminBundle\Export
{
use Sonata\CoreBundle\Exporter\Exporter as BaseExporter;
class Exporter extends BaseExporter
{
}
}
namespace Sonata\AdminBundle\Filter
{
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
interface FilterInterface
{
const CONDITION_OR ='OR';
const CONDITION_AND ='AND';
public function filter(ProxyQueryInterface $queryBuilder, $alias, $field, $value);
public function apply($query, $value);
public function getName();
public function getFormName();
public function getLabel();
public function setLabel($label);
public function getDefaultOptions();
public function getOption($name, $default = null);
public function setOption($name, $value);
public function initialize($name, array $options = array());
public function getFieldName();
public function getParentAssociationMappings();
public function getFieldMapping();
public function getAssociationMapping();
public function getFieldOptions();
public function getFieldType();
public function getRenderSettings();
public function isActive();
public function setCondition($condition);
public function getCondition();
public function getTranslationDomain();
}
}
namespace Sonata\AdminBundle\Filter
{
abstract class Filter implements FilterInterface
{
protected $name = null;
protected $value = null;
protected $options = array();
protected $condition;
public function initialize($name, array $options = array())
{
$this->name = $name;
$this->setOptions($options);
}
public function getName()
{
return $this->name;
}
public function getFormName()
{
return str_replace('.','__', $this->name);
}
public function getOption($name, $default = null)
{
if (array_key_exists($name, $this->options)) {
return $this->options[$name];
}
return $default;
}
public function setOption($name, $value)
{
$this->options[$name] = $value;
}
public function getFieldType()
{
return $this->getOption('field_type','text');
}
public function getFieldOptions()
{
return $this->getOption('field_options', array('required'=> false));
}
public function getLabel()
{
return $this->getOption('label');
}
public function setLabel($label)
{
$this->setOption('label', $label);
}
public function getFieldName()
{
$fieldName = $this->getOption('field_name');
if (!$fieldName) {
throw new \RuntimeException(sprintf('The option `field_name` must be set for field: `%s`', $this->getName()));
}
return $fieldName;
}
public function getParentAssociationMappings()
{
return $this->getOption('parent_association_mappings', array());
}
public function getFieldMapping()
{
$fieldMapping = $this->getOption('field_mapping');
if (!$fieldMapping) {
throw new \RuntimeException(sprintf('The option `field_mapping` must be set for field: `%s`', $this->getName()));
}
return $fieldMapping;
}
public function getAssociationMapping()
{
$associationMapping = $this->getOption('association_mapping');
if (!$associationMapping) {
throw new \RuntimeException(sprintf('The option `association_mapping` must be set for field: `%s`', $this->getName()));
}
return $associationMapping;
}
public function setOptions(array $options)
{
$this->options = array_merge($this->getDefaultOptions(), $options);
}
public function getOptions()
{
return $this->options;
}
public function setValue($value)
{
$this->value = $value;
}
public function getValue()
{
return $this->value;
}
public function isActive()
{
$values = $this->getValue();
return isset($values['value'])
&& false !== $values['value']
&&''!== $values['value'];
}
public function setCondition($condition)
{
$this->condition = $condition;
}
public function getCondition()
{
return $this->condition;
}
public function getTranslationDomain()
{
return $this->getOption('translation_domain');
}
}
}
namespace Sonata\AdminBundle\Filter
{
interface FilterFactoryInterface
{
public function create($name, $type, array $options = array());
}
}
namespace Sonata\AdminBundle\Filter
{
use Symfony\Component\DependencyInjection\ContainerInterface;
class FilterFactory implements FilterFactoryInterface
{
protected $container;
protected $types;
public function __construct(ContainerInterface $container, array $types = array())
{
$this->container = $container;
$this->types = $types;
}
public function create($name, $type, array $options = array())
{
if (!$type) {
throw new \RunTimeException('The type must be defined');
}
$id = isset($this->types[$type]) ? $this->types[$type] : false;
if (!$id) {
throw new \RunTimeException(sprintf('No attached service to type named `%s`', $type));
}
$filter = $this->container->get($id);
if (!$filter instanceof FilterInterface) {
throw new \RunTimeException(sprintf('The service `%s` must implement `FilterInterface`', $id));
}
$filter->initialize($name, $options);
return $filter;
}
}
}
namespace Symfony\Component\Form\Extension\Core\ChoiceList
{
interface ChoiceListInterface
{
public function getChoices();
public function getValues();
public function getPreferredViews();
public function getRemainingViews();
public function getChoicesForValues(array $values);
public function getValuesForChoices(array $choices);
public function getIndicesForChoices(array $choices);
public function getIndicesForValues(array $values);
}
}
namespace Symfony\Component\Form\Extension\Core\ChoiceList
{
@trigger_error('The '.__NAMESPACE__.'\ChoiceList class is deprecated since version 2.7 and will be removed in 3.0. Use Symfony\Component\Form\ChoiceList\ArrayChoiceList instead.', E_USER_DEPRECATED);
use Symfony\Component\Form\FormConfigBuilder;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\Exception\InvalidConfigurationException;
use Symfony\Component\Form\Exception\InvalidArgumentException;
use Symfony\Component\Form\Extension\Core\View\ChoiceView;
class ChoiceList implements ChoiceListInterface
{
protected $choices = array();
protected $values = array();
private $preferredViews = array();
private $remainingViews = array();
public function __construct($choices, array $labels, array $preferredChoices = array())
{
if (!is_array($choices) && !$choices instanceof \Traversable) {
throw new UnexpectedTypeException($choices,'array or \Traversable');
}
$this->initialize($choices, $labels, $preferredChoices);
}
protected function initialize($choices, array $labels, array $preferredChoices)
{
$this->choices = array();
$this->values = array();
$this->preferredViews = array();
$this->remainingViews = array();
$this->addChoices(
$this->preferredViews,
$this->remainingViews,
$choices,
$labels,
$preferredChoices
);
}
public function getChoices()
{
return $this->choices;
}
public function getValues()
{
return $this->values;
}
public function getPreferredViews()
{
return $this->preferredViews;
}
public function getRemainingViews()
{
return $this->remainingViews;
}
public function getChoicesForValues(array $values)
{
$values = $this->fixValues($values);
$choices = array();
foreach ($values as $i => $givenValue) {
foreach ($this->values as $j => $value) {
if ($value === $givenValue) {
$choices[$i] = $this->choices[$j];
unset($values[$i]);
if (0 === count($values)) {
break 2;
}
}
}
}
return $choices;
}
public function getValuesForChoices(array $choices)
{
$choices = $this->fixChoices($choices);
$values = array();
foreach ($choices as $i => $givenChoice) {
foreach ($this->choices as $j => $choice) {
if ($choice === $givenChoice) {
$values[$i] = $this->values[$j];
unset($choices[$i]);
if (0 === count($choices)) {
break 2;
}
}
}
}
return $values;
}
public function getIndicesForChoices(array $choices)
{
@trigger_error('The '.__METHOD__.' method is deprecated since version 2.4 and will be removed in 3.0.', E_USER_DEPRECATED);
$choices = $this->fixChoices($choices);
$indices = array();
foreach ($choices as $i => $givenChoice) {
foreach ($this->choices as $j => $choice) {
if ($choice === $givenChoice) {
$indices[$i] = $j;
unset($choices[$i]);
if (0 === count($choices)) {
break 2;
}
}
}
}
return $indices;
}
public function getIndicesForValues(array $values)
{
@trigger_error('The '.__METHOD__.' method is deprecated since version 2.4 and will be removed in 3.0.', E_USER_DEPRECATED);
$values = $this->fixValues($values);
$indices = array();
foreach ($values as $i => $givenValue) {
foreach ($this->values as $j => $value) {
if ($value === $givenValue) {
$indices[$i] = $j;
unset($values[$i]);
if (0 === count($values)) {
break 2;
}
}
}
}
return $indices;
}
protected function addChoices(array &$bucketForPreferred, array &$bucketForRemaining, $choices, array $labels, array $preferredChoices)
{
foreach ($choices as $group => $choice) {
if (!array_key_exists($group, $labels)) {
throw new InvalidArgumentException('The structures of the choices and labels array do not match.');
}
if (is_array($choice)) {
if (count($choice) > 0) {
$this->addChoiceGroup(
$group,
$bucketForPreferred,
$bucketForRemaining,
$choice,
$labels[$group],
$preferredChoices
);
}
} else {
$this->addChoice(
$bucketForPreferred,
$bucketForRemaining,
$choice,
$labels[$group],
$preferredChoices
);
}
}
}
protected function addChoiceGroup($group, array &$bucketForPreferred, array &$bucketForRemaining, array $choices, array $labels, array $preferredChoices)
{
$bucketForPreferred[$group] = array();
$bucketForRemaining[$group] = array();
$this->addChoices(
$bucketForPreferred[$group],
$bucketForRemaining[$group],
$choices,
$labels,
$preferredChoices
);
if (empty($bucketForPreferred[$group])) {
unset($bucketForPreferred[$group]);
}
if (empty($bucketForRemaining[$group])) {
unset($bucketForRemaining[$group]);
}
}
protected function addChoice(array &$bucketForPreferred, array &$bucketForRemaining, $choice, $label, array $preferredChoices)
{
$index = $this->createIndex($choice);
if (''=== $index || null === $index || !FormConfigBuilder::isValidName((string) $index)) {
throw new InvalidConfigurationException(sprintf('The index "%s" created by the choice list is invalid. It should be a valid, non-empty Form name.', $index));
}
$value = $this->createValue($choice);
if (!is_string($value)) {
throw new InvalidConfigurationException(sprintf('The value created by the choice list is of type "%s", but should be a string.', gettype($value)));
}
$view = new ChoiceView($choice, $value, $label);
$this->choices[$index] = $this->fixChoice($choice);
$this->values[$index] = $value;
if ($this->isPreferred($choice, $preferredChoices)) {
$bucketForPreferred[$index] = $view;
} else {
$bucketForRemaining[$index] = $view;
}
}
protected function isPreferred($choice, array $preferredChoices)
{
return in_array($choice, $preferredChoices, true);
}
protected function createIndex($choice)
{
return count($this->choices);
}
protected function createValue($choice)
{
return (string) count($this->values);
}
protected function fixValue($value)
{
return (string) $value;
}
protected function fixValues(array $values)
{
foreach ($values as $i => $value) {
$values[$i] = $this->fixValue($value);
}
return $values;
}
protected function fixIndex($index)
{
if (is_bool($index) || (string) (int) $index === (string) $index) {
return (int) $index;
}
return (string) $index;
}
protected function fixIndices(array $indices)
{
foreach ($indices as $i => $index) {
$indices[$i] = $this->fixIndex($index);
}
return $indices;
}
protected function fixChoice($choice)
{
return $choice;
}
protected function fixChoices(array $choices)
{
return $choices;
}
}
}
namespace Symfony\Component\Form\Extension\Core\ChoiceList
{
@trigger_error('The '.__NAMESPACE__.'\SimpleChoiceList class is deprecated since version 2.7 and will be removed in 3.0. Use Symfony\Component\Form\ChoiceList\ArrayChoiceList instead.', E_USER_DEPRECATED);
class SimpleChoiceList extends ChoiceList
{
public function __construct(array $choices, array $preferredChoices = array())
{
parent::__construct($choices, $choices, array_flip($preferredChoices));
}
public function getChoicesForValues(array $values)
{
$values = $this->fixValues($values);
return $this->fixChoices(array_intersect($values, $this->getValues()));
}
public function getValuesForChoices(array $choices)
{
$choices = $this->fixChoices($choices);
return $this->fixValues(array_intersect($choices, $this->getValues()));
}
protected function addChoices(array &$bucketForPreferred, array &$bucketForRemaining, $choices, array $labels, array $preferredChoices)
{
foreach ($choices as $choice => $label) {
if (is_array($label)) {
if (count($label) > 0) {
$this->addChoiceGroup(
$choice,
$bucketForPreferred,
$bucketForRemaining,
$label,
$label,
$preferredChoices
);
}
} else {
$this->addChoice(
$bucketForPreferred,
$bucketForRemaining,
$choice,
$label,
$preferredChoices
);
}
}
}
protected function isPreferred($choice, array $preferredChoices)
{
return isset($preferredChoices[$choice]);
}
protected function fixChoice($choice)
{
return $this->fixIndex($choice);
}
protected function fixChoices(array $choices)
{
return $this->fixIndices($choices);
}
protected function createValue($choice)
{
return (string) $choice;
}
}
}
namespace Sonata\AdminBundle\Form\ChoiceList
{
use Doctrine\Common\Util\ClassUtils;
use Sonata\AdminBundle\Model\ModelManagerInterface;
use Symfony\Component\Form\Exception\InvalidArgumentException;
use Symfony\Component\Form\Exception\RuntimeException;
use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyPath;
class ModelChoiceList extends SimpleChoiceList
{
private $modelManager;
private $class;
private $entities = array();
private $query;
private $identifier = array();
private $reflProperties = array();
private $propertyPath;
public function __construct(ModelManagerInterface $modelManager, $class, $property = null, $query = null, $choices = array())
{
$this->modelManager = $modelManager;
$this->class = $class;
$this->query = $query;
$this->identifier = $this->modelManager->getIdentifierFieldNames($this->class);
if ($property) {
$this->propertyPath = new PropertyPath($property);
}
parent::__construct($this->load($choices));
}
protected function load($choices)
{
if (is_array($choices)) {
$entities = $choices;
} elseif ($this->query) {
$entities = $this->modelManager->executeQuery($this->query);
} else {
$entities = $this->modelManager->findBy($this->class);
}
$choices = array();
$this->entities = array();
foreach ($entities as $key => $entity) {
if ($this->propertyPath) {
$propertyAccessor = PropertyAccess::createPropertyAccessor();
$value = $propertyAccessor->getValue($entity, $this->propertyPath);
} else {
try {
$value = (string) $entity;
} catch (\Exception $e) {
throw new RuntimeException(sprintf("Unable to convert the entity %s to String, entity must have a '__toString()' method defined", ClassUtils::getClass($entity)), 0, $e);
}
}
if (count($this->identifier) > 1) {
$choices[$key] = $value;
$this->entities[$key] = $entity;
} else {
$id = current($this->getIdentifierValues($entity));
$choices[$id] = $value;
$this->entities[$id] = $entity;
}
}
return $choices;
}
public function getIdentifier()
{
return $this->identifier;
}
public function getEntities()
{
return $this->entities;
}
public function getEntity($key)
{
if (count($this->identifier) > 1) {
$entities = $this->getEntities();
return isset($entities[$key]) ? $entities[$key] : null;
} elseif ($this->entities) {
return isset($this->entities[$key]) ? $this->entities[$key] : null;
}
return $this->modelManager->find($this->class, $key);
}
private function getReflProperty($property)
{
if (!isset($this->reflProperties[$property])) {
$this->reflProperties[$property] = new \ReflectionProperty($this->class, $property);
$this->reflProperties[$property]->setAccessible(true);
}
return $this->reflProperties[$property];
}
public function getIdentifierValues($entity)
{
try {
return $this->modelManager->getIdentifierValues($entity);
} catch (\Exception $e) {
throw new InvalidArgumentException(sprintf('Unable to retrieve the identifier values for entity %s', ClassUtils::getClass($entity)), 0, $e);
}
}
public function getModelManager()
{
return $this->modelManager;
}
public function getClass()
{
return $this->class;
}
}
}
namespace Symfony\Component\Form
{
use Symfony\Component\Form\Exception\TransformationFailedException;
interface DataTransformerInterface
{
public function transform($value);
public function reverseTransform($value);
}
}
namespace Sonata\AdminBundle\Form\DataTransformer
{
use Sonata\AdminBundle\Model\ModelManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
class ArrayToModelTransformer implements DataTransformerInterface
{
protected $modelManager;
protected $className;
public function __construct(ModelManagerInterface $modelManager, $className)
{
$this->modelManager = $modelManager;
$this->className = $className;
}
public function reverseTransform($array)
{
if ($array instanceof $this->className) {
return $array;
}
$instance = new $this->className();
if (!is_array($array)) {
return $instance;
}
return $this->modelManager->modelReverseTransform($this->className, $array);
}
public function transform($value)
{
return $value;
}
}
}
namespace Sonata\AdminBundle\Form\DataTransformer
{
use Sonata\AdminBundle\Form\ChoiceList\ModelChoiceList;
use Symfony\Component\Form\ChoiceList\LegacyChoiceListAdapter;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
class ModelsToArrayTransformer implements DataTransformerInterface
{
protected $choiceList;
public function __construct($choiceList)
{
if ($choiceList instanceof LegacyChoiceListAdapter && $choiceList->getAdaptedList() instanceof ModelChoiceList) {
$this->choiceList = $choiceList->getAdaptedList();
} elseif ($choiceList instanceof ModelChoiceList) {
$this->choiceList = $choiceList;
} else {
new \InvalidArgumentException('Argument 1 passed to '.__CLASS__.'::'.__METHOD__.' must be an instance of Sonata\AdminBundle\Form\ChoiceList\ModelChoiceList, instance of '.get_class($choiceList).' given');
}
}
public function transform($collection)
{
if (null === $collection) {
return array();
}
$array = array();
if (count($this->choiceList->getIdentifier()) > 1) {
$availableEntities = $this->choiceList->getEntities();
foreach ($collection as $entity) {
$key = array_search($entity, $availableEntities);
$array[] = $key;
}
} else {
foreach ($collection as $entity) {
$array[] = current($this->choiceList->getIdentifierValues($entity));
}
}
return $array;
}
public function reverseTransform($keys)
{
$collection = $this->choiceList->getModelManager()->getModelCollectionInstance(
$this->choiceList->getClass()
);
if (!$collection instanceof \ArrayAccess) {
throw new UnexpectedTypeException($collection,'\ArrayAccess');
}
if (''=== $keys || null === $keys) {
return $collection;
}
if (!is_array($keys)) {
throw new UnexpectedTypeException($keys,'array');
}
$notFound = array();
foreach ($keys as $key) {
if ($entity = $this->choiceList->getEntity($key)) {
$collection[] = $entity;
} else {
$notFound[] = $key;
}
}
if (count($notFound) > 0) {
throw new TransformationFailedException(sprintf('The entities with keys "%s" could not be found', implode('", "', $notFound)));
}
return $collection;
}
}
}
namespace Sonata\AdminBundle\Form\DataTransformer
{
use Sonata\AdminBundle\Model\ModelManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
class ModelToIdTransformer implements DataTransformerInterface
{
protected $modelManager;
protected $className;
public function __construct(ModelManagerInterface $modelManager, $className)
{
$this->modelManager = $modelManager;
$this->className = $className;
}
public function reverseTransform($newId)
{
if (empty($newId) && !in_array($newId, array('0', 0), true)) {
return;
}
return $this->modelManager->find($this->className, $newId);
}
public function transform($entity)
{
if (empty($entity)) {
return;
}
return $this->modelManager->getNormalizedIdentifier($entity);
}
}
}
namespace Sonata\AdminBundle\Form\EventListener
{
use Sonata\AdminBundle\Model\ModelManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
class MergeCollectionListener implements EventSubscriberInterface
{
protected $modelManager;
public function __construct(ModelManagerInterface $modelManager)
{
$this->modelManager = $modelManager;
}
public static function getSubscribedEvents()
{
return array(
FormEvents::SUBMIT => array('onBind', 10),
);
}
public function onBind(FormEvent $event)
{
$collection = $event->getForm()->getData();
$data = $event->getData();
$event->stopPropagation();
if (!$collection) {
$collection = $data;
} elseif (count($data) === 0) {
$this->modelManager->collectionClear($collection);
} else {
foreach ($collection as $entity) {
if (!$this->modelManager->collectionHasElement($data, $entity)) {
$this->modelManager->collectionRemoveElement($collection, $entity);
} else {
$this->modelManager->collectionRemoveElement($data, $entity);
}
}
foreach ($data as $entity) {
$this->modelManager->collectionAddElement($collection, $entity);
}
}
$event->setData($collection);
}
}
}
namespace Symfony\Component\Form
{
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
interface FormTypeExtensionInterface
{
public function buildForm(FormBuilderInterface $builder, array $options);
public function buildView(FormView $view, FormInterface $form, array $options);
public function finishView(FormView $view, FormInterface $form, array $options);
public function setDefaultOptions(OptionsResolverInterface $resolver);
public function getExtendedType();
}
}
namespace Symfony\Component\Form
{
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
abstract class AbstractTypeExtension implements FormTypeExtensionInterface
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
}
public function buildView(FormView $view, FormInterface $form, array $options)
{
}
public function finishView(FormView $view, FormInterface $form, array $options)
{
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
if (!$resolver instanceof OptionsResolver) {
throw new \InvalidArgumentException(sprintf('Custom resolver "%s" must extend "Symfony\Component\OptionsResolver\OptionsResolver".', get_class($resolver)));
}
$this->configureOptions($resolver);
}
public function configureOptions(OptionsResolver $resolver)
{
}
}
}
namespace Sonata\AdminBundle\Form\Extension\Field\Type
{
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Sonata\AdminBundle\Exception\NoValueException;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class FormTypeFieldExtension extends AbstractTypeExtension
{
protected $defaultClasses = array();
public function __construct(array $defaultClasses = array())
{
$this->defaultClasses = $defaultClasses;
}
public function buildForm(FormBuilderInterface $builder, array $options)
{
$sonataAdmin = array('name'=> null,'admin'=> null,'value'=> null,'edit'=>'standard','inline'=>'natural','field_description'=> null,'block_name'=> false,
);
$builder->setAttribute('sonata_admin_enabled', false);
$builder->setAttribute('sonata_help', false);
if ($options['sonata_field_description'] instanceof FieldDescriptionInterface) {
$fieldDescription = $options['sonata_field_description'];
$sonataAdmin['admin'] = $fieldDescription->getAdmin();
$sonataAdmin['field_description'] = $fieldDescription;
$sonataAdmin['name'] = $fieldDescription->getName();
$sonataAdmin['edit'] = $fieldDescription->getOption('edit','standard');
$sonataAdmin['inline'] = $fieldDescription->getOption('inline','natural');
$sonataAdmin['block_name'] = $fieldDescription->getOption('block_name', false);
$sonataAdmin['class'] = $this->getClass($builder);
$builder->setAttribute('sonata_admin_enabled', true);
}
$builder->setAttribute('sonata_admin', $sonataAdmin);
}
protected function getClass(FormBuilderInterface $formBuilder)
{
foreach ($this->getTypes($formBuilder) as $type) {
if (isset($this->defaultClasses[$type->getName()])) {
return $this->defaultClasses[$type->getName()];
}
}
return'';
}
protected function getTypes(FormBuilderInterface $formBuilder)
{
$types = array();
for ($type = $formBuilder->getType(); null !== $type; $type = $type->getParent()) {
array_unshift($types, $type->getInnerType());
}
return $types;
}
public function buildView(FormView $view, FormInterface $form, array $options)
{
$sonataAdmin = $form->getConfig()->getAttribute('sonata_admin');
$sonataAdminHelp = isset($options['sonata_help']) ? $options['sonata_help'] : null;
if ($sonataAdmin && $form->getConfig()->getAttribute('sonata_admin_enabled', true)) {
$sonataAdmin['value'] = $form->getData();
$block_prefixes = $view->vars['block_prefixes'];
$baseName = str_replace('.','_', $sonataAdmin['admin']->getCode());
$baseType = $block_prefixes[count($block_prefixes) - 2];
$blockSuffix = preg_replace('#^_([a-z0-9]{14})_(.++)$#','$2', array_pop($block_prefixes));
$block_prefixes[] = sprintf('%s_%s', $baseName, $baseType);
$block_prefixes[] = sprintf('%s_%s_%s', $baseName, $sonataAdmin['name'], $baseType);
$block_prefixes[] = sprintf('%s_%s_%s_%s', $baseName, $sonataAdmin['name'], $baseType, $blockSuffix);
if (isset($sonataAdmin['block_name']) && $sonataAdmin['block_name'] !== false) {
$block_prefixes[] = $sonataAdmin['block_name'];
}
$view->vars['block_prefixes'] = $block_prefixes;
$view->vars['sonata_admin_enabled'] = true;
$view->vars['sonata_admin'] = $sonataAdmin;
$attr = $view->vars['attr'];
if (!isset($attr['class']) && isset($sonataAdmin['class'])) {
$attr['class'] = $sonataAdmin['class'];
}
$view->vars['attr'] = $attr;
} else {
$view->vars['sonata_admin_enabled'] = false;
}
$view->vars['sonata_help'] = $sonataAdminHelp;
$view->vars['sonata_admin'] = $sonataAdmin;
}
public function getExtendedType()
{
return
method_exists('Symfony\Component\Form\AbstractType','getBlockPrefix') ?'Symfony\Component\Form\Extension\Core\Type\FormType':'form';
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('sonata_admin'=> null,'sonata_field_description'=> null,'label_render'=> true,'sonata_help'=> null,
));
}
public function getValueFromFieldDescription($object, FieldDescriptionInterface $fieldDescription)
{
$value = null;
if (!$object) {
return $value;
}
try {
$value = $fieldDescription->getValue($object);
} catch (NoValueException $e) {
if ($fieldDescription->getAssociationAdmin()) {
$value = $fieldDescription->getAssociationAdmin()->getNewInstance();
}
}
return $value;
}
}
}
namespace Sonata\AdminBundle\Mapper
{
abstract class BaseGroupedMapper extends BaseMapper
{
protected $currentGroup;
protected $currentTab;
abstract protected function getGroups();
abstract protected function getTabs();
abstract protected function setGroups(array $groups);
abstract protected function setTabs(array $tabs);
public function with($name, array $options = array())
{
$defaultOptions = array('collapsed'=> false,'class'=> false,'description'=> false,'translation_domain'=> null,'name'=> $name,
);
$code = $name;
if (array_key_exists('tab', $options) && $options['tab']) {
$tabs = $this->getTabs();
if ($this->currentTab) {
if (isset($tabs[$this->currentTab]['auto_created']) && true === $tabs[$this->currentTab]['auto_created']) {
throw new \RuntimeException('New tab was added automatically when you have added field or group. You should close current tab before adding new one OR add tabs before adding groups and fields.');
} else {
throw new \RuntimeException(sprintf('You should close previous tab "%s" with end() before adding new tab "%s".', $this->currentTab, $name));
}
} elseif ($this->currentGroup) {
throw new \RuntimeException(sprintf('You should open tab before adding new group "%s".', $name));
}
if (!isset($tabs[$name])) {
$tabs[$name] = array();
}
$tabs[$code] = array_merge($defaultOptions, array('auto_created'=> false,'groups'=> array(),
), $tabs[$code], $options);
$this->currentTab = $code;
} else {
if ($this->currentGroup) {
throw new \RuntimeException(sprintf('You should close previous group "%s" with end() before adding new tab "%s".', $this->currentGroup, $name));
}
if (!$this->currentTab) {
$this->with('default', array('tab'=> true,'auto_created'=> true,'translation_domain'=> isset($options['translation_domain']) ? $options['translation_domain'] : null,
)); }
if ($this->currentTab !=='default') {
$code = $this->currentTab.'.'.$name; }
$groups = $this->getGroups();
if (!isset($groups[$code])) {
$groups[$code] = array();
}
$groups[$code] = array_merge($defaultOptions, array('fields'=> array(),
), $groups[$code], $options);
$this->currentGroup = $code;
$this->setGroups($groups);
$tabs = $this->getTabs();
}
if ($this->currentGroup && isset($tabs[$this->currentTab]) && !in_array($this->currentGroup, $tabs[$this->currentTab]['groups'])) {
$tabs[$this->currentTab]['groups'][] = $this->currentGroup;
}
$this->setTabs($tabs);
return $this;
}
public function tab($name, array $options = array())
{
return $this->with($name, array_merge($options, array('tab'=> true)));
}
public function end()
{
if ($this->currentGroup !== null) {
$this->currentGroup = null;
} elseif ($this->currentTab !== null) {
$this->currentTab = null;
} else {
throw new \RuntimeException('No open tabs or groups, you cannot use end()');
}
return $this;
}
protected function addFieldToCurrentGroup($fieldName)
{
$currentGroup = $this->getCurrentGroupName();
$groups = $this->getGroups();
$groups[$currentGroup]['fields'][$fieldName] = $fieldName;
$this->setGroups($groups);
return $groups[$currentGroup];
}
protected function getCurrentGroupName()
{
if (!$this->currentGroup) {
$this->with($this->admin->getLabel(), array('auto_created'=> true));
}
return $this->currentGroup;
}
}
}
namespace Sonata\AdminBundle\Form
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Builder\FormContractorInterface;
use Sonata\AdminBundle\Mapper\BaseGroupedMapper;
use Symfony\Component\Form\FormBuilder;
class FormMapper extends BaseGroupedMapper
{
protected $formBuilder;
public function __construct(FormContractorInterface $formContractor, FormBuilder $formBuilder, AdminInterface $admin)
{
parent::__construct($formContractor, $admin);
$this->formBuilder = $formBuilder;
}
public function reorder(array $keys)
{
$this->admin->reorderFormGroup($this->getCurrentGroupName(), $keys);
return $this;
}
public function add($name, $type = null, array $options = array(), array $fieldDescriptionOptions = array())
{
if ($name instanceof FormBuilder) {
$fieldName = $name->getName();
} else {
$fieldName = $name;
}
if (!$name instanceof FormBuilder && strpos($fieldName,'.') !== false && !isset($options['property_path'])) {
$options['property_path'] = $fieldName;
$fieldName = str_replace('.','__', $fieldName);
}
if ($type =='collection') {
$type ='sonata_type_native_collection';
}
$label = $fieldName;
$group = $this->addFieldToCurrentGroup($label);
if (!isset($fieldDescriptionOptions['type']) && is_string($type)) {
$fieldDescriptionOptions['type'] = $type;
}
if ($group['translation_domain'] && !isset($fieldDescriptionOptions['translation_domain'])) {
$fieldDescriptionOptions['translation_domain'] = $group['translation_domain'];
}
$fieldDescription = $this->admin->getModelManager()->getNewFieldDescriptionInstance(
$this->admin->getClass(),
$name instanceof FormBuilder ? $name->getName() : $name,
$fieldDescriptionOptions
);
$this->builder->fixFieldDescription($this->admin, $fieldDescription, $fieldDescriptionOptions);
if ($fieldName != $name) {
$fieldDescription->setName($fieldName);
}
$this->admin->addFormFieldDescription($fieldName, $fieldDescription);
if ($name instanceof FormBuilder) {
$this->formBuilder->add($name);
} else {
$options = array_replace_recursive($this->builder->getDefaultOptions($type, $fieldDescription), $options);
if (!isset($options['label_render'])) {
$options['label_render'] = false;
}
if (!isset($options['label'])) {
$options['label'] = $this->admin->getLabelTranslatorStrategy()->getLabel($fieldDescription->getName(),'form','label');
}
$help = null;
if (isset($options['help'])) {
$help = $options['help'];
unset($options['help']);
}
$this->formBuilder->add($fieldDescription->getName(), $type, $options);
if (null !== $help) {
$this->admin->getFormFieldDescription($fieldDescription->getName())->setHelp($help);
}
}
return $this;
}
public function get($name)
{
return $this->formBuilder->get($name);
}
public function has($key)
{
return $this->formBuilder->has($key);
}
public function remove($key)
{
$this->admin->removeFormFieldDescription($key);
$this->admin->removeFieldFromFormGroup($key);
$this->formBuilder->remove($key);
return $this;
}
public function getFormBuilder()
{
return $this->formBuilder;
}
public function create($name, $type = null, array $options = array())
{
return $this->formBuilder->create($name, $type, $options);
}
public function setHelps(array $helps = array())
{
foreach ($helps as $name => $help) {
if ($this->admin->hasFormFieldDescription($name)) {
$this->admin->getFormFieldDescription($name)->setHelp($help);
}
}
return $this;
}
protected function getGroups()
{
return $this->admin->getFormGroups();
}
protected function setGroups(array $groups)
{
$this->admin->setFormGroups($groups);
}
protected function getTabs()
{
return $this->admin->getFormTabs();
}
protected function setTabs(array $tabs)
{
$this->admin->setFormTabs($tabs);
}
}
}
namespace Sonata\AdminBundle\Form\Type
{
use Sonata\AdminBundle\Form\DataTransformer\ArrayToModelTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class AdminType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
$admin = clone $this->getAdmin($options);
if ($admin->hasParentFieldDescription()) {
$admin->getParentFieldDescription()->setAssociationAdmin($admin);
}
if ($options['delete'] && $admin->isGranted('DELETE')) {
if (!array_key_exists('translation_domain', $options['delete_options']['type_options'])) {
$options['delete_options']['type_options']['translation_domain'] = $admin->getTranslationDomain();
}
$builder->add('_delete', $options['delete_options']['type'], $options['delete_options']['type_options']);
}
$admin->setSubject($builder->getData());
$admin->defineFormBuilder($builder);
$builder->addModelTransformer(new ArrayToModelTransformer($admin->getModelManager(), $admin->getClass()));
}
public function buildView(FormView $view, FormInterface $form, array $options)
{
$view->vars['btn_add'] = $options['btn_add'];
$view->vars['btn_list'] = $options['btn_list'];
$view->vars['btn_delete'] = $options['btn_delete'];
$view->vars['btn_catalogue'] = $options['btn_catalogue'];
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('delete'=> function (Options $options) {
return $options['btn_delete'] !== false;
},'delete_options'=> array('type'=>'checkbox','type_options'=> array('required'=> false,'mapped'=> false,
),
),'auto_initialize'=> false,'btn_add'=>'link_add','btn_list'=>'link_list','btn_delete'=>'link_delete','btn_catalogue'=>'SonataAdminBundle',
));
}
protected function getFieldDescription(array $options)
{
if (!isset($options['sonata_field_description'])) {
throw new \RuntimeException('Please provide a valid `sonata_field_description` option');
}
return $options['sonata_field_description'];
}
protected function getAdmin(array $options)
{
return $this->getFieldDescription($options)->getAssociationAdmin();
}
public function getName()
{
return'sonata_type_admin';
}
}
}
namespace Sonata\AdminBundle\Form\Type\Filter
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Translation\TranslatorInterface;
class ChoiceType extends AbstractType
{
const TYPE_CONTAINS = 1;
const TYPE_NOT_CONTAINS = 2;
const TYPE_EQUAL = 3;
protected $translator;
public function __construct(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function getName()
{
return'sonata_type_filter_choice';
}
public function buildForm(FormBuilderInterface $builder, array $options)
{
$choices = array(
self::TYPE_CONTAINS => $this->translator->trans('label_type_contains', array(),'SonataAdminBundle'),
self::TYPE_NOT_CONTAINS => $this->translator->trans('label_type_not_contains', array(),'SonataAdminBundle'),
self::TYPE_EQUAL => $this->translator->trans('label_type_equals', array(),'SonataAdminBundle'),
);
$builder
->add('type','choice', array('choices'=> $choices,'required'=> false))
->add('value', $options['field_type'], array_merge(array('required'=> false), $options['field_options']))
;
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('field_type'=>'choice','field_options'=> array(),
));
}
}
}
namespace Sonata\AdminBundle\Form\Type\Filter
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Translation\TranslatorInterface;
class DateRangeType extends AbstractType
{
const TYPE_BETWEEN = 1;
const TYPE_NOT_BETWEEN = 2;
protected $translator;
public function __construct(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function getName()
{
return'sonata_type_filter_date_range';
}
public function buildForm(FormBuilderInterface $builder, array $options)
{
$choices = array(
self::TYPE_BETWEEN => $this->translator->trans('label_date_type_between', array(),'SonataAdminBundle'),
self::TYPE_NOT_BETWEEN => $this->translator->trans('label_date_type_not_between', array(),'SonataAdminBundle'),
);
$builder
->add('type','choice', array('choices'=> $choices,'required'=> false))
->add('value', $options['field_type'], array('field_options'=> $options['field_options']))
;
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('field_type'=>'sonata_type_date_range','field_options'=> array('format'=>'yyyy-MM-dd'),
));
}
}
}
namespace Sonata\AdminBundle\Form\Type\Filter
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Translation\TranslatorInterface;
class DateTimeRangeType extends AbstractType
{
const TYPE_BETWEEN = 1;
const TYPE_NOT_BETWEEN = 2;
protected $translator;
public function __construct(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function getName()
{
return'sonata_type_filter_datetime_range';
}
public function buildForm(FormBuilderInterface $builder, array $options)
{
$choices = array(
self::TYPE_BETWEEN => $this->translator->trans('label_date_type_between', array(),'SonataAdminBundle'),
self::TYPE_NOT_BETWEEN => $this->translator->trans('label_date_type_not_between', array(),'SonataAdminBundle'),
);
$builder
->add('type','choice', array('choices'=> $choices,'required'=> false))
->add('value', $options['field_type'], array('field_options'=> $options['field_options']))
;
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('field_type'=>'sonata_type_datetime_range','field_options'=> array('date_format'=>'yyyy-MM-dd'),
));
}
}
}
namespace Sonata\AdminBundle\Form\Type\Filter
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Translation\TranslatorInterface;
class DateTimeType extends AbstractType
{
const TYPE_GREATER_EQUAL = 1;
const TYPE_GREATER_THAN = 2;
const TYPE_EQUAL = 3;
const TYPE_LESS_EQUAL = 4;
const TYPE_LESS_THAN = 5;
const TYPE_NULL = 6;
const TYPE_NOT_NULL = 7;
protected $translator;
public function __construct(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function getName()
{
return'sonata_type_filter_datetime';
}
public function buildForm(FormBuilderInterface $builder, array $options)
{
$choices = array(
self::TYPE_EQUAL => $this->translator->trans('label_date_type_equal', array(),'SonataAdminBundle'),
self::TYPE_GREATER_EQUAL => $this->translator->trans('label_date_type_greater_equal', array(),'SonataAdminBundle'),
self::TYPE_GREATER_THAN => $this->translator->trans('label_date_type_greater_than', array(),'SonataAdminBundle'),
self::TYPE_LESS_EQUAL => $this->translator->trans('label_date_type_less_equal', array(),'SonataAdminBundle'),
self::TYPE_LESS_THAN => $this->translator->trans('label_date_type_less_than', array(),'SonataAdminBundle'),
self::TYPE_NULL => $this->translator->trans('label_date_type_null', array(),'SonataAdminBundle'),
self::TYPE_NOT_NULL => $this->translator->trans('label_date_type_not_null', array(),'SonataAdminBundle'),
);
$builder
->add('type','choice', array('choices'=> $choices,'required'=> false))
->add('value', $options['field_type'], array_merge(array('required'=> false), $options['field_options']))
;
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('field_type'=>'datetime','field_options'=> array('date_format'=>'yyyy-MM-dd'),
));
}
}
}
namespace Sonata\AdminBundle\Form\Type\Filter
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Optionsresolver\OptionsResolverInterface;
use Symfony\Component\Translation\TranslatorInterface;
class DateType extends AbstractType
{
const TYPE_GREATER_EQUAL = 1;
const TYPE_GREATER_THAN = 2;
const TYPE_EQUAL = 3;
const TYPE_LESS_EQUAL = 4;
const TYPE_LESS_THAN = 5;
const TYPE_NULL = 6;
const TYPE_NOT_NULL = 7;
protected $translator;
public function __construct(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function getName()
{
return'sonata_type_filter_date';
}
public function buildForm(FormBuilderInterface $builder, array $options)
{
$choices = array(
self::TYPE_EQUAL => $this->translator->trans('label_date_type_equal', array(),'SonataAdminBundle'),
self::TYPE_GREATER_EQUAL => $this->translator->trans('label_date_type_greater_equal', array(),'SonataAdminBundle'),
self::TYPE_GREATER_THAN => $this->translator->trans('label_date_type_greater_than', array(),'SonataAdminBundle'),
self::TYPE_LESS_EQUAL => $this->translator->trans('label_date_type_less_equal', array(),'SonataAdminBundle'),
self::TYPE_LESS_THAN => $this->translator->trans('label_date_type_less_than', array(),'SonataAdminBundle'),
self::TYPE_NULL => $this->translator->trans('label_date_type_null', array(),'SonataAdminBundle'),
self::TYPE_NOT_NULL => $this->translator->trans('label_date_type_not_null', array(),'SonataAdminBundle'),
);
$builder
->add('type','choice', array('choices'=> $choices,'required'=> false))
->add('value', $options['field_type'], array_merge(array('required'=> false), $options['field_options']))
;
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('field_type'=>'date','field_options'=> array('date_format'=>'yyyy-MM-dd'),
));
}
}
}
namespace Sonata\AdminBundle\Form\Type\Filter
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class DefaultType extends AbstractType
{
public function getName()
{
return'sonata_type_filter_default';
}
public function buildForm(FormBuilderInterface $builder, array $options)
{
$builder
->add('type', $options['operator_type'], array_merge(array('required'=> false), $options['operator_options']))
->add('value', $options['field_type'], array_merge(array('required'=> false), $options['field_options']))
;
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('operator_type'=>'hidden','operator_options'=> array(),'field_type'=>'text','field_options'=> array(),
));
}
}
}
namespace Sonata\AdminBundle\Form\Type\Filter
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Translation\TranslatorInterface;
class NumberType extends AbstractType
{
const TYPE_GREATER_EQUAL = 1;
const TYPE_GREATER_THAN = 2;
const TYPE_EQUAL = 3;
const TYPE_LESS_EQUAL = 4;
const TYPE_LESS_THAN = 5;
protected $translator;
public function __construct(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function getName()
{
return'sonata_type_filter_number';
}
public function buildForm(FormBuilderInterface $builder, array $options)
{
$choices = array(
self::TYPE_EQUAL => $this->translator->trans('label_type_equal', array(),'SonataAdminBundle'),
self::TYPE_GREATER_EQUAL => $this->translator->trans('label_type_greater_equal', array(),'SonataAdminBundle'),
self::TYPE_GREATER_THAN => $this->translator->trans('label_type_greater_than', array(),'SonataAdminBundle'),
self::TYPE_LESS_EQUAL => $this->translator->trans('label_type_less_equal', array(),'SonataAdminBundle'),
self::TYPE_LESS_THAN => $this->translator->trans('label_type_less_than', array(),'SonataAdminBundle'),
);
$builder
->add('type','choice', array('choices'=> $choices,'required'=> false))
->add('value', $options['field_type'], array_merge(array('required'=> false), $options['field_options']))
;
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('field_type'=>'number','field_options'=> array(),
));
}
}
}
namespace Sonata\AdminBundle\Form\Type
{
use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class ModelReferenceType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
$builder->addModelTransformer(new ModelToIdTransformer($options['model_manager'], $options['class']));
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('compound'=> false,'model_manager'=> null,'class'=> null,
));
}
public function getParent()
{
return'text';
}
public function getName()
{
return'sonata_type_model_reference';
}
}
}
namespace Sonata\AdminBundle\Form\Type
{
use Sonata\AdminBundle\Form\ChoiceList\ModelChoiceList;
use Sonata\AdminBundle\Form\DataTransformer\ModelsToArrayTransformer;
use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;
use Sonata\AdminBundle\Form\EventListener\MergeCollectionListener;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceListInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class ModelType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
if ($options['multiple']) {
$builder
->addEventSubscriber(new MergeCollectionListener($options['model_manager']))
->addViewTransformer(new ModelsToArrayTransformer($options['choice_list']), true);
} else {
$builder
->addViewTransformer(new ModelToIdTransformer($options['model_manager'], $options['class']), true)
;
}
}
public function buildView(FormView $view, FormInterface $form, array $options)
{
$view->vars['btn_add'] = $options['btn_add'];
$view->vars['btn_list'] = $options['btn_list'];
$view->vars['btn_delete'] = $options['btn_delete'];
$view->vars['btn_catalogue'] = $options['btn_catalogue'];
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('compound'=> function (Options $options) {
if (isset($options['multiple']) && $options['multiple']) {
if (isset($options['expanded']) && $options['expanded']) {
return true;
}
return false;
}
if (isset($options['expanded']) && $options['expanded']) {
return true;
}
return false;
},'template'=>'choice','multiple'=> false,'expanded'=> false,'model_manager'=> null,'class'=> null,'property'=> null,'query'=> null,'choices'=> null,'preferred_choices'=> array(),'btn_add'=>'link_add','btn_list'=>'link_list','btn_delete'=>'link_delete','btn_catalogue'=>'SonataAdminBundle','choice_list'=> function (Options $options, $previousValue) {
if ($previousValue instanceof ChoiceListInterface && count($choices = $previousValue->getChoices())) {
return $choices;
}
return new ModelChoiceList(
$options['model_manager'],
$options['class'],
$options['property'],
$options['query'],
$options['choices']
);
},
));
}
public function getParent()
{
return'choice';
}
public function getName()
{
return'sonata_type_model';
}
}
}
namespace Sonata\AdminBundle\Form\Type
{
use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class ModelTypeList extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
$builder
->resetViewTransformers()
->addViewTransformer(new ModelToIdTransformer($options['model_manager'], $options['class']));
}
public function buildView(FormView $view, FormInterface $form, array $options)
{
if (isset($view->vars['sonata_admin'])) {
$view->vars['sonata_admin']['edit'] ='list';
}
$view->vars['btn_add'] = $options['btn_add'];
$view->vars['btn_list'] = $options['btn_list'];
$view->vars['btn_delete'] = $options['btn_delete'];
$view->vars['btn_catalogue'] = $options['btn_catalogue'];
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$resolver->setDefaults(array('model_manager'=> null,'class'=> null,'btn_add'=>'link_add','btn_list'=>'link_list','btn_delete'=>'link_delete','btn_catalogue'=>'SonataAdminBundle',
));
}
public function getParent()
{
return'text';
}
public function getName()
{
return'sonata_type_model_list';
}
}
}
namespace Sonata\AdminBundle\Guesser
{
use Sonata\AdminBundle\Model\ModelManagerInterface;
interface TypeGuesserInterface
{
public function guessType($class, $property, ModelManagerInterface $modelManager);
}
}
namespace Sonata\AdminBundle\Guesser
{
use Sonata\AdminBundle\Model\ModelManagerInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\Guess\Guess;
class TypeGuesserChain implements TypeGuesserInterface
{
protected $guessers = array();
public function __construct(array $guessers)
{
foreach ($guessers as $guesser) {
if (!$guesser instanceof TypeGuesserInterface) {
throw new UnexpectedTypeException($guesser,'Sonata\AdminBundle\Guesser\TypeGuesserInterface');
}
if ($guesser instanceof self) {
$this->guessers = array_merge($this->guessers, $guesser->guessers);
} else {
$this->guessers[] = $guesser;
}
}
}
public function guessType($class, $property, ModelManagerInterface $modelManager)
{
return $this->guess(function ($guesser) use ($class, $property, $modelManager) {
return $guesser->guessType($class, $property, $modelManager);
});
}
private function guess(\Closure $closure)
{
$guesses = array();
foreach ($this->guessers as $guesser) {
if ($guess = $closure($guesser)) {
$guesses[] = $guess;
}
}
return Guess::getBestGuess($guesses);
}
}
}
namespace Sonata\AdminBundle\Model
{
interface AuditManagerInterface
{
public function setReader($serviceId, array $classes);
public function hasReader($class);
public function getReader($class);
}
}
namespace Sonata\AdminBundle\Model
{
use Symfony\Component\DependencyInjection\ContainerInterface;
class AuditManager implements AuditManagerInterface
{
protected $classes = array();
protected $readers = array();
protected $container;
public function __construct(ContainerInterface $container)
{
$this->container = $container;
}
public function setReader($serviceId, array $classes)
{
$this->readers[$serviceId] = $classes;
}
public function hasReader($class)
{
foreach ($this->readers as $classes) {
if (in_array($class, $classes)) {
return true;
}
}
return false;
}
public function getReader($class)
{
foreach ($this->readers as $readerId => $classes) {
if (in_array($class, $classes)) {
return $this->container->get($readerId);
}
}
throw new \RuntimeException(sprintf('The class "%s" does not have any reader manager', $class));
}
}
}
namespace Sonata\AdminBundle\Model
{
interface AuditReaderInterface
{
public function find($className, $id, $revision);
public function findRevisionHistory($className, $limit = 20, $offset = 0);
public function findRevision($classname, $revision);
public function findRevisions($className, $id);
public function diff($className, $id, $oldRevision, $newRevision);
}
}
namespace Sonata\AdminBundle\Model
{
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Sonata\AdminBundle\Datagrid\DatagridInterface;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
interface ModelManagerInterface
{
public function getNewFieldDescriptionInstance($class, $name, array $options = array());
public function create($object);
public function update($object);
public function delete($object);
public function findBy($class, array $criteria = array());
public function findOneBy($class, array $criteria = array());
public function find($class, $id);
public function batchDelete($class, ProxyQueryInterface $queryProxy);
public function getParentFieldDescription($parentAssociationMapping, $class);
public function createQuery($class, $alias ='o');
public function getModelIdentifier($class);
public function getIdentifierValues($model);
public function getIdentifierFieldNames($class);
public function getNormalizedIdentifier($model);
public function getUrlsafeIdentifier($model);
public function getModelInstance($class);
public function getModelCollectionInstance($class);
public function collectionRemoveElement(&$collection, &$element);
public function collectionAddElement(&$collection, &$element);
public function collectionHasElement(&$collection, &$element);
public function collectionClear(&$collection);
public function getSortParameters(FieldDescriptionInterface $fieldDescription, DatagridInterface $datagrid);
public function getDefaultSortValues($class);
public function modelReverseTransform($class, array $array = array());
public function modelTransform($class, $instance);
public function executeQuery($query);
public function getDataSourceIterator(DatagridInterface $datagrid, array $fields, $firstResult = null, $maxResult = null);
public function getExportFields($class);
public function getPaginationParameters(DatagridInterface $datagrid, $page);
public function addIdentifiersToQuery($class, ProxyQueryInterface $query, array $idx);
}
}
namespace Symfony\Component\Config\Loader
{
interface LoaderInterface
{
public function load($resource, $type = null);
public function supports($resource, $type = null);
public function getResolver();
public function setResolver(LoaderResolverInterface $resolver);
}
}
namespace Symfony\Component\Config\Loader
{
use Symfony\Component\Config\Exception\FileLoaderLoadException;
abstract class Loader implements LoaderInterface
{
protected $resolver;
public function getResolver()
{
return $this->resolver;
}
public function setResolver(LoaderResolverInterface $resolver)
{
$this->resolver = $resolver;
}
public function import($resource, $type = null)
{
return $this->resolve($resource, $type)->load($resource, $type);
}
public function resolve($resource, $type = null)
{
if ($this->supports($resource, $type)) {
return $this;
}
$loader = null === $this->resolver ? false : $this->resolver->resolve($resource, $type);
if (false === $loader) {
throw new FileLoaderLoadException($resource);
}
return $loader;
}
}
}
namespace Symfony\Component\Config\Loader
{
use Symfony\Component\Config\FileLocatorInterface;
use Symfony\Component\Config\Exception\FileLoaderLoadException;
use Symfony\Component\Config\Exception\FileLoaderImportCircularReferenceException;
abstract class FileLoader extends Loader
{
protected static $loading = array();
protected $locator;
private $currentDir;
public function __construct(FileLocatorInterface $locator)
{
$this->locator = $locator;
}
public function setCurrentDir($dir)
{
$this->currentDir = $dir;
}
public function getLocator()
{
return $this->locator;
}
public function import($resource, $type = null, $ignoreErrors = false, $sourceResource = null)
{
try {
$loader = $this->resolve($resource, $type);
if ($loader instanceof self && null !== $this->currentDir) {
$locator = $loader->getLocator();
if (null === $locator) {
@trigger_error('Not calling the parent constructor in '.get_class($loader).' which extends '.__CLASS__.' is deprecated since version 2.7 and will not be supported anymore in 3.0.', E_USER_DEPRECATED);
$locator = $this->locator;
}
$resource = $locator->locate($resource, $this->currentDir, false);
}
$resources = is_array($resource) ? $resource : array($resource);
for ($i = 0; $i < $resourcesCount = count($resources); ++$i) {
if (isset(self::$loading[$resources[$i]])) {
if ($i == $resourcesCount - 1) {
throw new FileLoaderImportCircularReferenceException(array_keys(self::$loading));
}
} else {
$resource = $resources[$i];
break;
}
}
self::$loading[$resource] = true;
try {
$ret = $loader->load($resource, $type);
} catch (\Exception $e) {
unset(self::$loading[$resource]);
throw $e;
} catch (\Throwable $e) {
unset(self::$loading[$resource]);
throw $e;
}
unset(self::$loading[$resource]);
return $ret;
} catch (FileLoaderImportCircularReferenceException $e) {
throw $e;
} catch (\Exception $e) {
if (!$ignoreErrors) {
if ($e instanceof FileLoaderLoadException) {
throw $e;
}
throw new FileLoaderLoadException($resource, $sourceResource, null, $e);
}
}
}
}
}
namespace Sonata\AdminBundle\Route
{
use Sonata\AdminBundle\Admin\Pool;
use Symfony\Component\Config\Loader\FileLoader;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\RouteCollection as SymfonyRouteCollection;
class AdminPoolLoader extends FileLoader
{
protected $pool;
protected $adminServiceIds = array();
protected $container;
public function __construct(Pool $pool, $adminServiceIds, ContainerInterface $container)
{
$this->pool = $pool;
$this->adminServiceIds = $adminServiceIds;
$this->container = $container;
}
public function supports($resource, $type = null)
{
if ($type =='sonata_admin') {
return true;
}
return false;
}
public function load($resource, $type = null)
{
$collection = new SymfonyRouteCollection();
foreach ($this->adminServiceIds as $id) {
$admin = $this->pool->getInstance($id);
foreach ($admin->getRoutes()->getElements() as $code => $route) {
$collection->add($route->getDefault('_sonata_name'), $route);
}
$reflection = new \ReflectionObject($admin);
$collection->addResource(new FileResource($reflection->getFileName()));
}
$reflection = new \ReflectionObject($this->container);
$collection->addResource(new FileResource($reflection->getFileName()));
return $collection;
}
}
}
namespace Sonata\AdminBundle\Route
{
use Sonata\AdminBundle\Admin\AdminInterface;
interface RouteGeneratorInterface
{
public function generateUrl(AdminInterface $admin, $name, array $parameters = array(), $absolute = false);
public function generateMenuUrl(AdminInterface $admin, $name, array $parameters = array(), $absolute = false);
public function generate($name, array $parameters = array(), $absolute = false);
public function hasAdminRoute(AdminInterface $admin, $name);
}
}
namespace Sonata\AdminBundle\Route
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Symfony\Component\Routing\RouterInterface;
class DefaultRouteGenerator implements RouteGeneratorInterface
{
private $router;
private $cache;
private $caches = array();
private $loaded = array();
public function __construct(RouterInterface $router, RoutesCache $cache)
{
$this->router = $router;
$this->cache = $cache;
}
public function generate($name, array $parameters = array(), $absolute = false)
{
return $this->router->generate($name, $parameters, $absolute);
}
public function generateUrl(AdminInterface $admin, $name, array $parameters = array(), $absolute = false)
{
$arrayRoute = $this->generateMenuUrl($admin, $name, $parameters, $absolute);
return $this->router->generate($arrayRoute['route'], $arrayRoute['routeParameters'], $arrayRoute['routeAbsolute']);
}
public function generateMenuUrl(AdminInterface $admin, $name, array $parameters = array(), $absolute = false)
{
if ($admin->isChild() && $admin->hasRequest() && $admin->getRequest()->attributes->has($admin->getParent()->getIdParameter())) {
if (isset($parameters['id'])) {
$parameters[$admin->getIdParameter()] = $parameters['id'];
unset($parameters['id']);
}
$parameters[$admin->getParent()->getIdParameter()] = $admin->getRequest()->attributes->get($admin->getParent()->getIdParameter());
}
if ($admin->hasParentFieldDescription()) {
$parameters = array_merge($parameters, $admin->getParentFieldDescription()->getOption('link_parameters', array()));
$parameters['uniqid'] = $admin->getUniqid();
$parameters['code'] = $admin->getCode();
$parameters['pcode'] = $admin->getParentFieldDescription()->getAdmin()->getCode();
$parameters['puniqid'] = $admin->getParentFieldDescription()->getAdmin()->getUniqid();
}
if ($name =='update'|| substr($name, -7) =='|update') {
$parameters['uniqid'] = $admin->getUniqid();
$parameters['code'] = $admin->getCode();
}
if ($admin->hasRequest()) {
$parameters = array_merge($admin->getPersistentParameters(), $parameters);
}
$code = $this->getCode($admin, $name);
if (!array_key_exists($code, $this->caches)) {
throw new \RuntimeException(sprintf('unable to find the route `%s`', $code));
}
return array('route'=> $this->caches[$code],'routeParameters'=> $parameters,'routeAbsolute'=> $absolute,
);
}
public function hasAdminRoute(AdminInterface $admin, $name)
{
return array_key_exists($this->getCode($admin, $name), $this->caches);
}
private function getCode(AdminInterface $admin, $name)
{
$this->loadCache($admin);
if ($admin->isChild()) {
return $admin->getBaseCodeRoute().'.'.$name;
}
if (array_key_exists($name, $this->caches)) {
return $name;
}
if (strpos($name,'.')) {
return $admin->getCode().'|'.$name;
}
return $admin->getCode().'.'.$name;
}
private function loadCache(AdminInterface $admin)
{
if ($admin->isChild()) {
$this->loadCache($admin->getParent());
} else {
if (in_array($admin->getCode(), $this->loaded)) {
return;
}
$this->caches = array_merge($this->cache->load($admin), $this->caches);
$this->loaded[] = $admin->getCode();
}
}
}
}
namespace Sonata\AdminBundle\Route
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Builder\RouteBuilderInterface;
use Sonata\AdminBundle\Model\AuditManagerInterface;
class PathInfoBuilder implements RouteBuilderInterface
{
protected $manager;
public function __construct(AuditManagerInterface $manager)
{
$this->manager = $manager;
}
public function build(AdminInterface $admin, RouteCollection $collection)
{
$collection->add('list');
$collection->add('create');
$collection->add('batch');
$collection->add('edit', $admin->getRouterIdParameter().'/edit');
$collection->add('delete', $admin->getRouterIdParameter().'/delete');
$collection->add('show', $admin->getRouterIdParameter().'/show');
$collection->add('export');
if ($this->manager->hasReader($admin->getClass())) {
$collection->add('history', $admin->getRouterIdParameter().'/history');
$collection->add('history_view_revision', $admin->getRouterIdParameter().'/history/{revision}/view');
$collection->add('history_compare_revisions', $admin->getRouterIdParameter().'/history/{base_revision}/{compare_revision}/compare');
}
if ($admin->isAclEnabled()) {
$collection->add('acl', $admin->getRouterIdParameter().'/acl');
}
if ($admin->getParent()) {
return;
}
foreach ($admin->getChildren() as $children) {
$collection->addCollection($children->getRoutes());
}
}
}
}
namespace Sonata\AdminBundle\Route
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Builder\RouteBuilderInterface;
use Sonata\AdminBundle\Model\AuditManagerInterface;
class QueryStringBuilder implements RouteBuilderInterface
{
protected $manager;
public function __construct(AuditManagerInterface $manager)
{
$this->manager = $manager;
}
public function build(AdminInterface $admin, RouteCollection $collection)
{
$collection->add('list');
$collection->add('create');
$collection->add('batch');
$collection->add('edit');
$collection->add('delete');
$collection->add('show');
$collection->add('export');
if ($this->manager->hasReader($admin->getClass())) {
$collection->add('history','/audit-history');
$collection->add('history_view_revision','/audit-history-view');
$collection->add('history_compare_revisions','/audit-history-compare');
}
if ($admin->isAclEnabled()) {
$collection->add('acl', $admin->getRouterIdParameter().'/acl');
}
if ($admin->getParent()) {
return;
}
foreach ($admin->getChildren() as $children) {
$collection->addCollection($children->getRoutes());
}
}
}
}
namespace Sonata\AdminBundle\Route
{
use Symfony\Component\Routing\Route;
class RouteCollection
{
protected $elements = array();
protected $baseCodeRoute;
protected $baseRouteName;
protected $baseControllerName;
protected $baseRoutePattern;
public function __construct($baseCodeRoute, $baseRouteName, $baseRoutePattern, $baseControllerName)
{
$this->baseCodeRoute = $baseCodeRoute;
$this->baseRouteName = $baseRouteName;
$this->baseRoutePattern = $baseRoutePattern;
$this->baseControllerName = $baseControllerName;
}
public function add($name, $pattern = null, array $defaults = array(), array $requirements = array(), array $options = array())
{
$pattern = $this->baseRoutePattern.'/'.($pattern ?: $name);
$code = $this->getCode($name);
$routeName = $this->baseRouteName.'_'.$name;
if (!isset($defaults['_controller'])) {
$defaults['_controller'] = $this->baseControllerName.':'.$this->actionify($code);
}
if (!isset($defaults['_sonata_admin'])) {
$defaults['_sonata_admin'] = $this->baseCodeRoute;
}
$defaults['_sonata_name'] = $routeName;
$this->elements[$this->getCode($name)] = function () use ($pattern, $defaults, $requirements, $options) {
return new Route($pattern, $defaults, $requirements, $options);
};
return $this;
}
public function getCode($name)
{
if (strrpos($name,'.') !== false) {
return $name;
}
return $this->baseCodeRoute.'.'.$name;
}
public function addCollection(RouteCollection $collection)
{
foreach ($collection->getElements() as $code => $route) {
$this->elements[$code] = $route;
}
return $this;
}
private function resolve($element)
{
if (is_callable($element)) {
return call_user_func($element);
}
return $element;
}
public function getElements()
{
foreach ($this->elements as $name => $element) {
$this->elements[$name] = $this->resolve($element);
}
return $this->elements;
}
public function has($name)
{
return array_key_exists($this->getCode($name), $this->elements);
}
public function get($name)
{
if ($this->has($name)) {
$code = $this->getCode($name);
$this->elements[$code] = $this->resolve($this->elements[$code]);
return $this->elements[$code];
}
throw new \InvalidArgumentException(sprintf('Element "%s" does not exist.', $name));
}
public function remove($name)
{
unset($this->elements[$this->getCode($name)]);
return $this;
}
public function clearExcept(array $routeList)
{
$routeCodeList = array();
foreach ($routeList as $name) {
$routeCodeList[] = $this->getCode($name);
}
$elements = $this->elements;
foreach ($elements as $key => $element) {
if (!in_array($key, $routeCodeList)) {
unset($this->elements[$key]);
}
}
return $this;
}
public function clear()
{
$this->elements = array();
return $this;
}
public function actionify($action)
{
if (($pos = strrpos($action,'.')) !== false) {
$action = substr($action, $pos + 1);
}
if (strpos($this->baseControllerName,':') === false) {
$action .='Action';
}
return lcfirst(str_replace(' ','', ucwords(strtr($action,'_-','  '))));
}
public function getBaseCodeRoute()
{
return $this->baseCodeRoute;
}
public function getBaseControllerName()
{
return $this->baseControllerName;
}
public function getBaseRouteName()
{
return $this->baseRouteName;
}
public function getBaseRoutePattern()
{
return $this->baseRoutePattern;
}
}
}
namespace Symfony\Component\Security\Acl\Permission
{
interface PermissionMapInterface
{
public function getMasks($permission, $object);
public function contains($permission);
}
}
namespace Sonata\AdminBundle\Security\Acl\Permission
{
use Symfony\Component\Security\Acl\Permission\PermissionMapInterface;
class AdminPermissionMap implements PermissionMapInterface
{
const PERMISSION_VIEW ='VIEW';
const PERMISSION_EDIT ='EDIT';
const PERMISSION_CREATE ='CREATE';
const PERMISSION_DELETE ='DELETE';
const PERMISSION_UNDELETE ='UNDELETE';
const PERMISSION_LIST ='LIST';
const PERMISSION_EXPORT ='EXPORT';
const PERMISSION_OPERATOR ='OPERATOR';
const PERMISSION_MASTER ='MASTER';
const PERMISSION_OWNER ='OWNER';
private $map = array(
self::PERMISSION_VIEW => array(
MaskBuilder::MASK_VIEW,
MaskBuilder::MASK_LIST,
MaskBuilder::MASK_EDIT,
MaskBuilder::MASK_OPERATOR,
MaskBuilder::MASK_MASTER,
MaskBuilder::MASK_OWNER,
),
self::PERMISSION_EDIT => array(
MaskBuilder::MASK_EDIT,
MaskBuilder::MASK_OPERATOR,
MaskBuilder::MASK_MASTER,
MaskBuilder::MASK_OWNER,
),
self::PERMISSION_CREATE => array(
MaskBuilder::MASK_CREATE,
MaskBuilder::MASK_OPERATOR,
MaskBuilder::MASK_MASTER,
MaskBuilder::MASK_OWNER,
),
self::PERMISSION_DELETE => array(
MaskBuilder::MASK_DELETE,
MaskBuilder::MASK_OPERATOR,
MaskBuilder::MASK_MASTER,
MaskBuilder::MASK_OWNER,
),
self::PERMISSION_UNDELETE => array(
MaskBuilder::MASK_UNDELETE,
MaskBuilder::MASK_OPERATOR,
MaskBuilder::MASK_MASTER,
MaskBuilder::MASK_OWNER,
),
self::PERMISSION_LIST => array(
MaskBuilder::MASK_LIST,
MaskBuilder::MASK_OPERATOR,
MaskBuilder::MASK_MASTER,
MaskBuilder::MASK_OWNER,
),
self::PERMISSION_EXPORT => array(
MaskBuilder::MASK_EXPORT,
MaskBuilder::MASK_OPERATOR,
MaskBuilder::MASK_MASTER,
MaskBuilder::MASK_OWNER,
),
self::PERMISSION_OPERATOR => array(
MaskBuilder::MASK_OPERATOR,
MaskBuilder::MASK_MASTER,
MaskBuilder::MASK_OWNER,
),
self::PERMISSION_MASTER => array(
MaskBuilder::MASK_MASTER,
MaskBuilder::MASK_OWNER,
),
self::PERMISSION_OWNER => array(
MaskBuilder::MASK_OWNER,
),
);
public function getMasks($permission, $object)
{
if (!isset($this->map[$permission])) {
return;
}
return $this->map[$permission];
}
public function contains($permission)
{
return isset($this->map[$permission]);
}
}
}
namespace Symfony\Component\Security\Acl\Permission
{
interface MaskBuilderInterface
{
public function set($mask);
public function get();
public function add($mask);
public function remove($mask);
public function reset();
public function resolveMask($code);
}
}
namespace Symfony\Component\Security\Acl\Permission
{
abstract class AbstractMaskBuilder implements MaskBuilderInterface
{
protected $mask;
public function __construct($mask = 0)
{
$this->set($mask);
}
public function set($mask)
{
if (!is_int($mask)) {
throw new \InvalidArgumentException('$mask must be an integer.');
}
$this->mask = $mask;
return $this;
}
public function get()
{
return $this->mask;
}
public function add($mask)
{
$this->mask |= $this->resolveMask($mask);
return $this;
}
public function remove($mask)
{
$this->mask &= ~$this->resolveMask($mask);
return $this;
}
public function reset()
{
$this->mask = 0;
return $this;
}
}
}
namespace Symfony\Component\Security\Acl\Permission
{
class MaskBuilder extends AbstractMaskBuilder
{
const MASK_VIEW = 1; const MASK_CREATE = 2; const MASK_EDIT = 4; const MASK_DELETE = 8; const MASK_UNDELETE = 16; const MASK_OPERATOR = 32; const MASK_MASTER = 64; const MASK_OWNER = 128; const MASK_IDDQD = 1073741823;
const CODE_VIEW ='V';
const CODE_CREATE ='C';
const CODE_EDIT ='E';
const CODE_DELETE ='D';
const CODE_UNDELETE ='U';
const CODE_OPERATOR ='O';
const CODE_MASTER ='M';
const CODE_OWNER ='N';
const ALL_OFF ='................................';
const OFF ='.';
const ON ='*';
public function getPattern()
{
$pattern = self::ALL_OFF;
$length = strlen($pattern);
$bitmask = str_pad(decbin($this->mask), $length,'0', STR_PAD_LEFT);
for ($i = $length - 1; $i >= 0; --$i) {
if ('1'=== $bitmask[$i]) {
try {
$pattern[$i] = self::getCode(1 << ($length - $i - 1));
} catch (\Exception $e) {
$pattern[$i] = self::ON;
}
}
}
return $pattern;
}
public static function getCode($mask)
{
if (!is_int($mask)) {
throw new \InvalidArgumentException('$mask must be an integer.');
}
$reflection = new \ReflectionClass(get_called_class());
foreach ($reflection->getConstants() as $name => $cMask) {
if (0 !== strpos($name,'MASK_') || $mask !== $cMask) {
continue;
}
if (!defined($cName ='static::CODE_'.substr($name, 5))) {
throw new \RuntimeException('There was no code defined for this mask.');
}
return constant($cName);
}
throw new \InvalidArgumentException(sprintf('The mask "%d" is not supported.', $mask));
}
public function resolveMask($code)
{
if (is_string($code)) {
if (!defined($name = sprintf('static::MASK_%s', strtoupper($code)))) {
throw new \InvalidArgumentException(sprintf('The code "%s" is not supported', $code));
}
return constant($name);
}
if (!is_int($code)) {
throw new \InvalidArgumentException('$code must be an integer.');
}
return $code;
}
}
}
namespace Sonata\AdminBundle\Security\Acl\Permission
{
use Symfony\Component\Security\Acl\Permission\MaskBuilder as BaseMaskBuilder;
class MaskBuilder extends BaseMaskBuilder
{
const MASK_LIST = 4096; const MASK_EXPORT = 8192;
const CODE_LIST ='L';
const CODE_EXPORT ='E';
}
}
namespace Sonata\AdminBundle\Security\Handler
{
use Sonata\AdminBundle\Admin\AdminInterface;
interface SecurityHandlerInterface
{
public function isGranted(AdminInterface $admin, $attributes, $object = null);
public function getBaseRole(AdminInterface $admin);
public function buildSecurityInformation(AdminInterface $admin);
public function createObjectSecurity(AdminInterface $admin, $object);
public function deleteObjectSecurity(AdminInterface $admin, $object);
}
}
namespace Sonata\AdminBundle\Security\Handler
{
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Model\AclInterface;
use Symfony\Component\Security\Acl\Model\ObjectIdentityInterface;
interface AclSecurityHandlerInterface extends SecurityHandlerInterface
{
public function setAdminPermissions(array $permissions);
public function getAdminPermissions();
public function setObjectPermissions(array $permissions);
public function getObjectPermissions();
public function getObjectAcl(ObjectIdentityInterface $objectIdentity);
public function findObjectAcls(\Traversable $oids, array $sids = array());
public function addObjectOwner(AclInterface $acl, UserSecurityIdentity $securityIdentity = null);
public function addObjectClassAces(AclInterface $acl, array $roleInformation = array());
public function createAcl(ObjectIdentityInterface $objectIdentity);
public function updateAcl(AclInterface $acl);
public function deleteAcl(ObjectIdentityInterface $objectIdentity);
public function findClassAceIndexByRole(AclInterface $acl, $role);
public function findClassAceIndexByUsername(AclInterface $acl, $username);
}
}
namespace Sonata\AdminBundle\Security\Handler
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\RoleSecurityIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Exception\AclNotFoundException;
use Symfony\Component\Security\Acl\Exception\NotAllAclsFoundException;
use Symfony\Component\Security\Acl\Model\AclInterface;
use Symfony\Component\Security\Acl\Model\MutableAclProviderInterface;
use Symfony\Component\Security\Acl\Model\ObjectIdentityInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationCredentialsNotFoundException;
use Symfony\Component\Security\Core\SecurityContextInterface;
class AclSecurityHandler implements AclSecurityHandlerInterface
{
protected $securityContext;
protected $aclProvider;
protected $superAdminRoles;
protected $adminPermissions;
protected $objectPermissions;
protected $maskBuilderClass;
public function __construct(SecurityContextInterface $securityContext, MutableAclProviderInterface $aclProvider, $maskBuilderClass, array $superAdminRoles)
{
$this->securityContext = $securityContext;
$this->aclProvider = $aclProvider;
$this->maskBuilderClass = $maskBuilderClass;
$this->superAdminRoles = $superAdminRoles;
}
public function setAdminPermissions(array $permissions)
{
$this->adminPermissions = $permissions;
}
public function getAdminPermissions()
{
return $this->adminPermissions;
}
public function setObjectPermissions(array $permissions)
{
$this->objectPermissions = $permissions;
}
public function getObjectPermissions()
{
return $this->objectPermissions;
}
public function isGranted(AdminInterface $admin, $attributes, $object = null)
{
if (!is_array($attributes)) {
$attributes = array($attributes);
}
try {
return $this->securityContext->isGranted($this->superAdminRoles) || $this->securityContext->isGranted($attributes, $object);
} catch (AuthenticationCredentialsNotFoundException $e) {
return false;
} catch (\Exception $e) {
throw $e;
}
}
public function getBaseRole(AdminInterface $admin)
{
return'ROLE_'.str_replace('.','_', strtoupper($admin->getCode())).'_%s';
}
public function buildSecurityInformation(AdminInterface $admin)
{
$baseRole = $this->getBaseRole($admin);
$results = array();
foreach ($admin->getSecurityInformation() as $role => $permissions) {
$results[sprintf($baseRole, $role)] = $permissions;
}
return $results;
}
public function createObjectSecurity(AdminInterface $admin, $object)
{
$objectIdentity = ObjectIdentity::fromDomainObject($object);
$acl = $this->getObjectAcl($objectIdentity);
if (is_null($acl)) {
$acl = $this->createAcl($objectIdentity);
}
$user = $this->securityContext->getToken()->getUser();
$securityIdentity = UserSecurityIdentity::fromAccount($user);
$this->addObjectOwner($acl, $securityIdentity);
$this->addObjectClassAces($acl, $this->buildSecurityInformation($admin));
$this->updateAcl($acl);
}
public function deleteObjectSecurity(AdminInterface $admin, $object)
{
$objectIdentity = ObjectIdentity::fromDomainObject($object);
$this->deleteAcl($objectIdentity);
}
public function getObjectAcl(ObjectIdentityInterface $objectIdentity)
{
try {
$acl = $this->aclProvider->findAcl($objectIdentity);
} catch (AclNotFoundException $e) {
return;
}
return $acl;
}
public function findObjectAcls(\Traversable $oids, array $sids = array())
{
try {
$acls = $this->aclProvider->findAcls(iterator_to_array($oids), $sids);
} catch (\Exception $e) {
if ($e instanceof NotAllAclsFoundException) {
$acls = $e->getPartialResult();
} elseif ($e instanceof AclNotFoundException) {
$acls = new \SplObjectStorage();
} else {
throw $e;
}
}
return $acls;
}
public function addObjectOwner(AclInterface $acl, UserSecurityIdentity $securityIdentity = null)
{
if (false === $this->findClassAceIndexByUsername($acl, $securityIdentity->getUsername())) {
$acl->insertObjectAce($securityIdentity, constant("$this->maskBuilderClass::MASK_OWNER"));
}
}
public function addObjectClassAces(AclInterface $acl, array $roleInformation = array())
{
$builder = new $this->maskBuilderClass();
foreach ($roleInformation as $role => $permissions) {
$aceIndex = $this->findClassAceIndexByRole($acl, $role);
$hasRole = false;
foreach ($permissions as $permission) {
if (in_array($permission, $this->getObjectPermissions())) {
$builder->add($permission);
$hasRole = true;
}
}
if ($hasRole) {
if ($aceIndex === false) {
$acl->insertClassAce(new RoleSecurityIdentity($role), $builder->get());
} else {
$acl->updateClassAce($aceIndex, $builder->get());
}
$builder->reset();
} elseif ($aceIndex !== false) {
$acl->deleteClassAce($aceIndex);
}
}
}
public function createAcl(ObjectIdentityInterface $objectIdentity)
{
return $this->aclProvider->createAcl($objectIdentity);
}
public function updateAcl(AclInterface $acl)
{
$this->aclProvider->updateAcl($acl);
}
public function deleteAcl(ObjectIdentityInterface $objectIdentity)
{
$this->aclProvider->deleteAcl($objectIdentity);
}
public function findClassAceIndexByRole(AclInterface $acl, $role)
{
foreach ($acl->getClassAces() as $index => $entry) {
if ($entry->getSecurityIdentity() instanceof RoleSecurityIdentity && $entry->getSecurityIdentity()->getRole() === $role) {
return $index;
}
}
return false;
}
public function findClassAceIndexByUsername(AclInterface $acl, $username)
{
foreach ($acl->getClassAces() as $index => $entry) {
if ($entry->getSecurityIdentity() instanceof UserSecurityIdentity && $entry->getSecurityIdentity()->getUsername() === $username) {
return $index;
}
}
return false;
}
}
}
namespace Sonata\AdminBundle\Security\Handler
{
use Sonata\AdminBundle\Admin\AdminInterface;
class NoopSecurityHandler implements SecurityHandlerInterface
{
public function isGranted(AdminInterface $admin, $attributes, $object = null)
{
return true;
}
public function getBaseRole(AdminInterface $admin)
{
return'';
}
public function buildSecurityInformation(AdminInterface $admin)
{
return array();
}
public function createObjectSecurity(AdminInterface $admin, $object)
{
}
public function deleteObjectSecurity(AdminInterface $admin, $object)
{
}
}
}
namespace Sonata\AdminBundle\Security\Handler
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationCredentialsNotFoundException;
use Symfony\Component\Security\Core\SecurityContextInterface;
class RoleSecurityHandler implements SecurityHandlerInterface
{
protected $securityContext;
protected $superAdminRoles;
public function __construct(SecurityContextInterface $securityContext, array $superAdminRoles)
{
$this->securityContext = $securityContext;
$this->superAdminRoles = $superAdminRoles;
}
public function isGranted(AdminInterface $admin, $attributes, $object = null)
{
if (!is_array($attributes)) {
$attributes = array($attributes);
}
foreach ($attributes as $pos => $attribute) {
$attributes[$pos] = sprintf($this->getBaseRole($admin), $attribute);
}
try {
return $this->securityContext->isGranted($this->superAdminRoles)
|| $this->securityContext->isGranted($attributes, $object);
} catch (AuthenticationCredentialsNotFoundException $e) {
return false;
} catch (\Exception $e) {
throw $e;
}
}
public function getBaseRole(AdminInterface $admin)
{
return'ROLE_'.str_replace('.','_', strtoupper($admin->getCode())).'_%s';
}
public function buildSecurityInformation(AdminInterface $admin)
{
return array();
}
public function createObjectSecurity(AdminInterface $admin, $object)
{
}
public function deleteObjectSecurity(AdminInterface $admin, $object)
{
}
}
}
namespace Sonata\AdminBundle\Show
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Admin\FieldDescriptionCollection;
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Sonata\AdminBundle\Builder\ShowBuilderInterface;
use Sonata\AdminBundle\Mapper\BaseGroupedMapper;
class ShowMapper extends BaseGroupedMapper
{
protected $list;
public function __construct(ShowBuilderInterface $showBuilder, FieldDescriptionCollection $list, AdminInterface $admin)
{
parent::__construct($showBuilder, $admin);
$this->list = $list;
}
public function add($name, $type = null, array $fieldDescriptionOptions = array())
{
$fieldKey = ($name instanceof FieldDescriptionInterface) ? $name->getName() : $name;
$this->addFieldToCurrentGroup($fieldKey);
if ($name instanceof FieldDescriptionInterface) {
$fieldDescription = $name;
$fieldDescription->mergeOptions($fieldDescriptionOptions);
} elseif (is_string($name) && !$this->admin->hasShowFieldDescription($name)) {
$fieldDescription = $this->admin->getModelManager()->getNewFieldDescriptionInstance(
$this->admin->getClass(),
$name,
$fieldDescriptionOptions
);
} else {
throw new \RuntimeException('invalid state');
}
if (!$fieldDescription->getLabel()) {
$fieldDescription->setOption('label', $this->admin->getLabelTranslatorStrategy()->getLabel($fieldDescription->getName(),'show','label'));
}
$fieldDescription->setOption('safe', $fieldDescription->getOption('safe', false));
$this->builder->addField($this->list, $type, $fieldDescription, $this->admin);
return $this;
}
public function get($name)
{
return $this->list->get($name);
}
public function has($key)
{
return $this->list->has($key);
}
public function remove($key)
{
$this->admin->removeShowFieldDescription($key);
$this->list->remove($key);
return $this;
}
public function reorder(array $keys)
{
$this->admin->reorderShowGroup($this->getCurrentGroupName(), $keys);
return $this;
}
protected function getGroups()
{
return $this->admin->getShowGroups();
}
protected function setGroups(array $groups)
{
$this->admin->setShowGroups($groups);
}
protected function getTabs()
{
return $this->admin->getShowTabs();
}
protected function setTabs(array $tabs)
{
$this->admin->setShowTabs($tabs);
}
}
}
namespace Sonata\AdminBundle\Translator
{
interface LabelTranslatorStrategyInterface
{
public function getLabel($label, $context ='', $type ='');
}
}
namespace Sonata\AdminBundle\Translator
{
class BCLabelTranslatorStrategy implements LabelTranslatorStrategyInterface
{
public function getLabel($label, $context ='', $type ='')
{
if ($context =='breadcrumb') {
return sprintf('%s.%s_%s', $context, $type, strtolower($label));
}
return ucfirst(strtolower($label));
}
}
}
namespace Sonata\AdminBundle\Translator
{
class FormLabelTranslatorStrategy implements LabelTranslatorStrategyInterface
{
public function getLabel($label, $context ='', $type ='')
{
return ucfirst(strtolower($label));
}
}
}
namespace Sonata\AdminBundle\Translator
{
class NativeLabelTranslatorStrategy implements LabelTranslatorStrategyInterface
{
public function getLabel($label, $context ='', $type ='')
{
$label = str_replace(array('_','.'),' ', $label);
$label = strtolower(preg_replace('~(?<=\\w)([A-Z])~','_$1', $label));
return trim(ucwords(str_replace('_',' ', $label)));
}
}
}
namespace Sonata\AdminBundle\Translator
{
class NoopLabelTranslatorStrategy implements LabelTranslatorStrategyInterface
{
public function getLabel($label, $context ='', $type ='')
{
return $label;
}
}
}
namespace Sonata\AdminBundle\Translator
{
class UnderscoreLabelTranslatorStrategy implements LabelTranslatorStrategyInterface
{
public function getLabel($label, $context ='', $type ='')
{
$label = str_replace('.','_', $label);
return sprintf('%s.%s_%s', $context, $type, strtolower(preg_replace('~(?<=\\w)([A-Z])~','_$1', $label)));
}
}
}
namespace Sonata\AdminBundle\Twig\Extension
{
use Doctrine\Common\Util\ClassUtils;
use Psr\Log\LoggerInterface;
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Sonata\AdminBundle\Admin\Pool;
use Sonata\AdminBundle\Exception\NoValueException;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Twig_Environment;
class SonataAdminExtension extends \Twig_Extension
{
protected $pool;
protected $logger;
public function __construct(Pool $pool, LoggerInterface $logger = null)
{
$this->pool = $pool;
$this->logger = $logger;
}
public function getFilters()
{
return array(
new \Twig_SimpleFilter('render_list_element', array($this,'renderListElement'), array('is_safe'=> array('html'),'needs_environment'=> true)),
new \Twig_SimpleFilter('render_view_element', array($this,'renderViewElement'), array('is_safe'=> array('html'),'needs_environment'=> true)),
new \Twig_SimpleFilter('render_view_element_compare', array($this,'renderViewElementCompare'), array('is_safe'=> array('html'))),
new \Twig_SimpleFilter('render_relation_element', array($this,'renderRelationElement')),
new \Twig_SimpleFilter('sonata_urlsafeid', array($this,'getUrlsafeIdentifier')),
new \Twig_SimpleFilter('sonata_xeditable_type', array($this,'getXEditableType')),
);
}
public function getName()
{
return'sonata_admin';
}
protected function getTemplate(FieldDescriptionInterface $fieldDescription, $defaultTemplate, Twig_Environment $environment)
{
$templateName = $fieldDescription->getTemplate() ?: $defaultTemplate;
try {
$template = $environment->loadTemplate($templateName);
} catch (\Twig_Error_Loader $e) {
$template = $environment->loadTemplate($defaultTemplate);
if (null !== $this->logger) {
$this->logger->warning(sprintf('An error occured trying to load the template "%s" for the field "%s", the default template "%s" was used instead: "%s". ', $templateName, $fieldDescription->getFieldName(), $defaultTemplate, $e->getMessage()));
}
}
return $template;
}
public function renderListElement(Twig_Environment $environment, $object, FieldDescriptionInterface $fieldDescription, $params = array())
{
$template = $this->getTemplate($fieldDescription, $fieldDescription->getAdmin()->getTemplate('base_list_field'), $environment);
return $this->output($fieldDescription, $template, array_merge($params, array('admin'=> $fieldDescription->getAdmin(),'object'=> $object,'value'=> $this->getValueFromFieldDescription($object, $fieldDescription),'field_description'=> $fieldDescription,
)), $environment);
}
public function output(FieldDescriptionInterface $fieldDescription, \Twig_Template $template, array $parameters = array(), Twig_Environment $environment)
{
$content = $template->render($parameters);
if ($environment->isDebug()) {
return sprintf("\n<!-- START  \n  fieldName: %s\n  template: %s\n  compiled template: %s\n -->\n%s\n<!-- END - fieldName: %s -->",
$fieldDescription->getFieldName(),
$fieldDescription->getTemplate(),
$template->getTemplateName(),
$content,
$fieldDescription->getFieldName()
);
}
return $content;
}
public function getValueFromFieldDescription($object, FieldDescriptionInterface $fieldDescription, array $params = array())
{
if (isset($params['loop']) && $object instanceof \ArrayAccess) {
throw new \RuntimeException('remove the loop requirement');
}
$value = null;
try {
$value = $fieldDescription->getValue($object);
} catch (NoValueException $e) {
if ($fieldDescription->getAssociationAdmin()) {
$value = $fieldDescription->getAssociationAdmin()->getNewInstance();
}
}
return $value;
}
public function renderViewElement(Twig_Environment $environment, FieldDescriptionInterface $fieldDescription, $object)
{
$template = $this->getTemplate($fieldDescription,'SonataAdminBundle:CRUD:base_show_field.html.twig', $environment);
try {
$value = $fieldDescription->getValue($object);
} catch (NoValueException $e) {
$value = null;
}
return $this->output($fieldDescription, $template, array('field_description'=> $fieldDescription,'object'=> $object,'value'=> $value,'admin'=> $fieldDescription->getAdmin(),
), $environment);
}
public function renderViewElementCompare(Twig_Environment $environment, FieldDescriptionInterface $fieldDescription, $baseObject, $compareObject)
{
$template = $this->getTemplate($fieldDescription,'SonataAdminBundle:CRUD:base_show_field.html.twig', $environment);
try {
$baseValue = $fieldDescription->getValue($baseObject);
} catch (NoValueException $e) {
$baseValue = null;
}
try {
$compareValue = $fieldDescription->getValue($compareObject);
} catch (NoValueException $e) {
$compareValue = null;
}
$baseValueOutput = $template->render(array('admin'=> $fieldDescription->getAdmin(),'field_description'=> $fieldDescription,'value'=> $baseValue,
));
$compareValueOutput = $template->render(array('field_description'=> $fieldDescription,'admin'=> $fieldDescription->getAdmin(),'value'=> $compareValue,
));
$isDiff = $baseValueOutput !== $compareValueOutput;
return $this->output($fieldDescription, $template, array('field_description'=> $fieldDescription,'value'=> $baseValue,'value_compare'=> $compareValue,'is_diff'=> $isDiff,'admin'=> $fieldDescription->getAdmin(),
), $environment);
}
public function renderRelationElement($element, FieldDescriptionInterface $fieldDescription)
{
if (!is_object($element)) {
return $element;
}
$propertyPath = $fieldDescription->getOption('associated_property');
if (null === $propertyPath) {
$method = $fieldDescription->getOption('associated_tostring','__toString');
if (!method_exists($element, $method)) {
throw new \RuntimeException(sprintf('You must define an `associated_property` option or create a `%s::__toString` method to the field option %s from service %s is ',
get_class($element),
$fieldDescription->getName(),
$fieldDescription->getAdmin()->getCode()
));
}
return call_user_func(array($element, $method));
}
return PropertyAccess::createPropertyAccessor()->getValue($element, $propertyPath);
}
public function getUrlsafeIdentifier($model)
{
$admin = $this->pool->getAdminByClass(ClassUtils::getClass($model));
return $admin->getUrlsafeIdentifier($model);
}
public function getXEditableType($type)
{
$mapping = array('boolean'=>'select','text'=>'text','textarea'=>'textarea','email'=>'email','string'=>'text','smallint'=>'text','bigint'=>'text','integer'=>'number','decimal'=>'number','currency'=>'number','percent'=>'number','url'=>'url',
);
return isset($mapping[$type]) ? $mapping[$type] : false;
}
}
}
namespace Sonata\AdminBundle\Util
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Security\Handler\AclSecurityHandlerInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Acl\Model\AclInterface;
interface AdminAclManipulatorInterface
{
public function configureAcls(OutputInterface $output, AdminInterface $admin);
public function addAdminClassAces(OutputInterface $output, AclInterface $acl, AclSecurityHandlerInterface $securityHandler, array $roleInformation = array());
}
}
namespace Sonata\AdminBundle\Util
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Security\Handler\AclSecurityHandlerInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\RoleSecurityIdentity;
use Symfony\Component\Security\Acl\Model\AclInterface;
class AdminAclManipulator implements AdminAclManipulatorInterface
{
protected $maskBuilderClass;
public function __construct($maskBuilderClass)
{
$this->maskBuilderClass = $maskBuilderClass;
}
public function configureAcls(OutputInterface $output, AdminInterface $admin)
{
$securityHandler = $admin->getSecurityHandler();
if (!$securityHandler instanceof AclSecurityHandlerInterface) {
$output->writeln(sprintf('Admin `%s` is not configured to use ACL : <info>ignoring</info>', $admin->getCode()));
return;
}
$objectIdentity = ObjectIdentity::fromDomainObject($admin);
$newAcl = false;
if (is_null($acl = $securityHandler->getObjectAcl($objectIdentity))) {
$acl = $securityHandler->createAcl($objectIdentity);
$newAcl = true;
}
$output->writeln(sprintf(' > install ACL for %s', $admin->getCode()));
$configResult = $this->addAdminClassAces($output, $acl, $securityHandler, $securityHandler->buildSecurityInformation($admin));
if ($configResult) {
$securityHandler->updateAcl($acl);
} else {
$output->writeln(sprintf('   - %s , no roles and permissions found', ($newAcl ?'skip':'removed')));
$securityHandler->deleteAcl($objectIdentity);
}
}
public function addAdminClassAces(OutputInterface $output, AclInterface $acl, AclSecurityHandlerInterface $securityHandler, array $roleInformation = array())
{
if (count($securityHandler->getAdminPermissions()) > 0) {
$builder = new $this->maskBuilderClass();
foreach ($roleInformation as $role => $permissions) {
$aceIndex = $securityHandler->findClassAceIndexByRole($acl, $role);
$roleAdminPermissions = array();
foreach ($permissions as $permission) {
if (in_array($permission, $securityHandler->getAdminPermissions())) {
$builder->add($permission);
$roleAdminPermissions[] = $permission;
}
}
if (count($roleAdminPermissions) > 0) {
if ($aceIndex === false) {
$acl->insertClassAce(new RoleSecurityIdentity($role), $builder->get());
$action ='add';
} else {
$acl->updateClassAce($aceIndex, $builder->get());
$action ='update';
}
if (!is_null($output)) {
$output->writeln(sprintf('   - %s role: %s, permissions: %s', $action, $role, json_encode($roleAdminPermissions)));
}
$builder->reset();
} elseif ($aceIndex !== false) {
$acl->deleteClassAce($aceIndex);
if (!is_null($output)) {
$output->writeln(sprintf('   - remove role: %s', $role));
}
}
}
return true;
} else {
return false;
}
}
}
}
namespace Sonata\AdminBundle\Util
{
use Symfony\Component\Form\FormBuilder;
class FormBuilderIterator extends \RecursiveArrayIterator
{
protected static $reflection;
protected $formBuilder;
protected $keys = array();
protected $prefix;
public function __construct(FormBuilder $formBuilder, $prefix = false)
{
$this->formBuilder = $formBuilder;
$this->prefix = $prefix ? $prefix : $formBuilder->getName();
$this->iterator = new \ArrayIterator(self::getKeys($formBuilder));
}
private static function getKeys(FormBuilder $formBuilder)
{
if (!self::$reflection) {
self::$reflection = new \ReflectionProperty(get_class($formBuilder),'children');
self::$reflection->setAccessible(true);
}
return array_keys(self::$reflection->getValue($formBuilder));
}
public function rewind()
{
$this->iterator->rewind();
}
public function valid()
{
return $this->iterator->valid();
}
public function key()
{
$name = $this->iterator->current();
return sprintf('%s_%s', $this->prefix, $name);
}
public function next()
{
$this->iterator->next();
}
public function current()
{
return $this->formBuilder->get($this->iterator->current());
}
public function getChildren()
{
return new self($this->formBuilder->get($this->iterator->current()), $this->current());
}
public function hasChildren()
{
return count(self::getKeys($this->current())) > 0;
}
}
}
namespace Sonata\AdminBundle\Util
{
use Symfony\Component\Form\FormView;
class FormViewIterator implements \RecursiveIterator
{
protected $formView;
public function __construct(FormView $formView)
{
$this->iterator = $formView->getIterator();
}
public function getChildren()
{
return new self($this->current());
}
public function hasChildren()
{
return count($this->current()->children) > 0;
}
public function current()
{
return $this->iterator->current();
}
public function next()
{
$this->iterator->next();
}
public function key()
{
return $this->current()->vars['id'];
}
public function valid()
{
return $this->iterator->valid();
}
public function rewind()
{
$this->iterator->rewind();
}
}
}
namespace Sonata\AdminBundle\Util
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
interface ObjectAclManipulatorInterface
{
public function batchConfigureAcls(OutputInterface $output, AdminInterface $admin, UserSecurityIdentity $securityIdentity = null);
}
}
namespace Sonata\AdminBundle\Util
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Security\Handler\AclSecurityHandlerInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
abstract class ObjectAclManipulator implements ObjectAclManipulatorInterface
{
public function configureAcls(OutputInterface $output, AdminInterface $admin, \Traversable $oids, UserSecurityIdentity $securityIdentity = null)
{
$countAdded = 0;
$countUpdated = 0;
$securityHandler = $admin->getSecurityHandler();
if (!$securityHandler instanceof AclSecurityHandlerInterface) {
$output->writeln(sprintf('Admin `%s` is not configured to use ACL : <info>ignoring</info>', $admin->getCode()));
return array(0, 0);
}
$acls = $securityHandler->findObjectAcls($oids);
foreach ($oids as $oid) {
if ($acls->contains($oid)) {
$acl = $acls->offsetGet($oid);
++$countUpdated;
} else {
$acl = $securityHandler->createAcl($oid);
++$countAdded;
}
if (!is_null($securityIdentity)) {
$securityHandler->addObjectOwner($acl, $securityIdentity);
}
$securityHandler->addObjectClassAces($acl, $securityHandler->buildSecurityInformation($admin));
try {
$securityHandler->updateAcl($acl);
} catch (\Exception $e) {
$output->writeln(sprintf('Error saving ObjectIdentity (%s, %s) ACL : %s <info>ignoring</info>', $oid->getIdentifier(), $oid->getType(), $e->getMessage()));
}
}
return array($countAdded, $countUpdated);
}
}
}
namespace Symfony\Component\Validator
{
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;
use Symfony\Component\Validator\Exception\InvalidArgumentException;
use Symfony\Component\Validator\Exception\InvalidOptionsException;
use Symfony\Component\Validator\Exception\MissingOptionsException;
abstract class Constraint
{
const DEFAULT_GROUP ='Default';
const CLASS_CONSTRAINT ='class';
const PROPERTY_CONSTRAINT ='property';
protected static $errorNames = array();
public $payload;
public static function getErrorName($errorCode)
{
if (!isset(static::$errorNames[$errorCode])) {
throw new InvalidArgumentException(sprintf('The error code "%s" does not exist for constraint of type "%s".',
$errorCode,
get_called_class()
));
}
return static::$errorNames[$errorCode];
}
public function __construct($options = null)
{
$invalidOptions = array();
$missingOptions = array_flip((array) $this->getRequiredOptions());
$knownOptions = get_object_vars($this);
$knownOptions['groups'] = true;
if (is_array($options) && count($options) >= 1 && isset($options['value']) && !property_exists($this,'value')) {
$options[$this->getDefaultOption()] = $options['value'];
unset($options['value']);
}
if (is_array($options) && count($options) > 0 && is_string(key($options))) {
foreach ($options as $option => $value) {
if (array_key_exists($option, $knownOptions)) {
$this->$option = $value;
unset($missingOptions[$option]);
} else {
$invalidOptions[] = $option;
}
}
} elseif (null !== $options && !(is_array($options) && count($options) === 0)) {
$option = $this->getDefaultOption();
if (null === $option) {
throw new ConstraintDefinitionException(
sprintf('No default option is configured for constraint %s', get_class($this))
);
}
if (array_key_exists($option, $knownOptions)) {
$this->$option = $options;
unset($missingOptions[$option]);
} else {
$invalidOptions[] = $option;
}
}
if (count($invalidOptions) > 0) {
throw new InvalidOptionsException(
sprintf('The options "%s" do not exist in constraint %s', implode('", "', $invalidOptions), get_class($this)),
$invalidOptions
);
}
if (count($missingOptions) > 0) {
throw new MissingOptionsException(
sprintf('The options "%s" must be set for constraint %s', implode('", "', array_keys($missingOptions)), get_class($this)),
array_keys($missingOptions)
);
}
}
public function __set($option, $value)
{
if ('groups'=== $option) {
$this->groups = (array) $value;
return;
}
throw new InvalidOptionsException(sprintf('The option "%s" does not exist in constraint %s', $option, get_class($this)), array($option));
}
public function __get($option)
{
if ('groups'=== $option) {
$this->groups = array(self::DEFAULT_GROUP);
return $this->groups;
}
throw new InvalidOptionsException(sprintf('The option "%s" does not exist in constraint %s', $option, get_class($this)), array($option));
}
public function addImplicitGroupName($group)
{
if (in_array(self::DEFAULT_GROUP, $this->groups) && !in_array($group, $this->groups)) {
$this->groups[] = $group;
}
}
public function getDefaultOption()
{
}
public function getRequiredOptions()
{
return array();
}
public function validatedBy()
{
return get_class($this).'Validator';
}
public function getTargets()
{
return self::PROPERTY_CONSTRAINT;
}
public function __sleep()
{
$this->groups;
return array_keys(get_object_vars($this));
}
}
}
namespace Sonata\AdminBundle\Validator\Constraints
{
use Symfony\Component\Validator\Constraint;
class InlineConstraint extends Constraint
{
protected $service;
protected $method;
public function validatedBy()
{
return'sonata.admin.validator.inline';
}
public function isClosure()
{
return $this->method instanceof \Closure;
}
public function getClosure()
{
return $this->method;
}
public function getTargets()
{
return self::CLASS_CONSTRAINT;
}
public function getRequiredOptions()
{
return array('service','method',
);
}
public function getMethod()
{
return $this->method;
}
public function getService()
{
return $this->service;
}
}
}
namespace Sonata\AdminBundle\Validator
{
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyPath;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidatorFactoryInterface;
use Symfony\Component\Validator\ExecutionContextInterface;
class ErrorElement
{
protected $context;
protected $group;
protected $constraintValidatorFactory;
protected $stack = array();
protected $propertyPaths = array();
protected $subject;
protected $current;
protected $basePropertyPath;
protected $errors = array();
public function __construct($subject, ConstraintValidatorFactoryInterface $constraintValidatorFactory, ExecutionContextInterface $context, $group)
{
$this->subject = $subject;
$this->context = $context;
$this->group = $group;
$this->constraintValidatorFactory = $constraintValidatorFactory;
$this->current ='';
$this->basePropertyPath = $this->context->getPropertyPath();
}
public function __call($name, array $arguments = array())
{
if (substr($name, 0, 6) =='assert') {
$this->validate($this->newConstraint(substr($name, 6), isset($arguments[0]) ? $arguments[0] : array()));
} else {
throw new \RunTimeException('Unable to recognize the command');
}
return $this;
}
public function addConstraint(Constraint $constraint)
{
$this->validate($constraint);
return $this;
}
public function with($name, $key = false)
{
$key = $key ? $name.'.'.$key : $name;
$this->stack[] = $key;
$this->current = implode('.', $this->stack);
if (!isset($this->propertyPaths[$this->current])) {
$this->propertyPaths[$this->current] = new PropertyPath($this->current);
}
return $this;
}
public function end()
{
array_pop($this->stack);
$this->current = implode('.', $this->stack);
return $this;
}
protected function validate(Constraint $constraint)
{
$subPath = (string) $this->getCurrentPropertyPath();
$this->context->validateValue($this->getValue(), $constraint, $subPath, $this->group);
}
public function getFullPropertyPath()
{
if ($this->getCurrentPropertyPath()) {
return sprintf('%s.%s', $this->basePropertyPath, $this->getCurrentPropertyPath());
} else {
return $this->basePropertyPath;
}
}
protected function getValue()
{
if ($this->current =='') {
return $this->subject;
}
$propertyAccessor = PropertyAccess::createPropertyAccessor();
return $propertyAccessor->getValue($this->subject, $this->getCurrentPropertyPath());
}
public function getSubject()
{
return $this->subject;
}
protected function newConstraint($name, array $options = array())
{
if (strpos($name,'\\') !== false && class_exists($name)) {
$className = (string) $name;
} else {
$className ='Symfony\\Component\\Validator\\Constraints\\'.$name;
}
return new $className($options);
}
protected function getCurrentPropertyPath()
{
if (!isset($this->propertyPaths[$this->current])) {
return; }
return $this->propertyPaths[$this->current];
}
public function addViolation($message, $parameters = array(), $value = null)
{
if (is_array($message)) {
$value = isset($message[2]) ? $message[2] : $value;
$parameters = isset($message[1]) ? (array) $message[1] : array();
$message = isset($message[0]) ? $message[0] :'error';
}
$subPath = (string) $this->getCurrentPropertyPath();
$this->context->addViolationAt($subPath, $message, $parameters, $value);
$this->errors[] = array($message, $parameters, $value);
return $this;
}
public function getErrors()
{
return $this->errors;
}
}
}
namespace Symfony\Component\Validator
{
interface ConstraintValidatorInterface
{
public function initialize(ExecutionContextInterface $context);
public function validate($value, Constraint $constraint);
}
}
namespace Symfony\Component\Validator
{
use Symfony\Component\Validator\Context\ExecutionContextInterface as ExecutionContextInterface2Dot5;
use Symfony\Component\Validator\Violation\ConstraintViolationBuilderInterface;
use Symfony\Component\Validator\Violation\LegacyConstraintViolationBuilder;
abstract class ConstraintValidator implements ConstraintValidatorInterface
{
const PRETTY_DATE = 1;
const OBJECT_TO_STRING = 2;
protected $context;
public function initialize(ExecutionContextInterface $context)
{
$this->context = $context;
}
protected function buildViolation($message, array $parameters = array())
{
@trigger_error('The '.__METHOD__.' is deprecated since version 2.5 and will be removed in 3.0.', E_USER_DEPRECATED);
if ($this->context instanceof ExecutionContextInterface2Dot5) {
return $this->context->buildViolation($message, $parameters);
}
return new LegacyConstraintViolationBuilder($this->context, $message, $parameters);
}
protected function buildViolationInContext(ExecutionContextInterface $context, $message, array $parameters = array())
{
@trigger_error('The '.__METHOD__.' is deprecated since version 2.5 and will be removed in 3.0.', E_USER_DEPRECATED);
if ($context instanceof ExecutionContextInterface2Dot5) {
return $context->buildViolation($message, $parameters);
}
return new LegacyConstraintViolationBuilder($context, $message, $parameters);
}
protected function formatTypeOf($value)
{
return is_object($value) ? get_class($value) : gettype($value);
}
protected function formatValue($value, $format = 0)
{
$isDateTime = $value instanceof \DateTime || $value instanceof \DateTimeInterface;
if (($format & self::PRETTY_DATE) && $isDateTime) {
if (class_exists('IntlDateFormatter')) {
$locale = \Locale::getDefault();
$formatter = new \IntlDateFormatter($locale, \IntlDateFormatter::MEDIUM, \IntlDateFormatter::SHORT);
if (!$value instanceof \DateTime) {
$value = new \DateTime(
$value->format('Y-m-d H:i:s.u e'),
$value->getTimezone()
);
}
return $formatter->format($value);
}
return $value->format('Y-m-d H:i:s');
}
if (is_object($value)) {
if (($format & self::OBJECT_TO_STRING) && method_exists($value,'__toString')) {
return $value->__toString();
}
return'object';
}
if (is_array($value)) {
return'array';
}
if (is_string($value)) {
return'"'.$value.'"';
}
if (is_resource($value)) {
return'resource';
}
if (null === $value) {
return'null';
}
if (false === $value) {
return'false';
}
if (true === $value) {
return'true';
}
return (string) $value;
}
protected function formatValues(array $values, $format = 0)
{
foreach ($values as $key => $value) {
$values[$key] = $this->formatValue($value, $format);
}
return implode(', ', $values);
}
}
}
namespace Sonata\AdminBundle\Validator
{
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\ConstraintValidatorFactoryInterface;
class InlineValidator extends ConstraintValidator
{
protected $container;
public function __construct(ContainerInterface $container, ConstraintValidatorFactoryInterface $constraintValidatorFactory)
{
$this->container = $container;
$this->constraintValidatorFactory = $constraintValidatorFactory;
}
public function validate($value, Constraint $constraint)
{
$errorElement = new ErrorElement(
$value,
$this->constraintValidatorFactory,
$this->context,
$this->context->getGroup()
);
if ($constraint->isClosure()) {
$function = $constraint->getClosure();
} else {
if (is_string($constraint->getService())) {
$service = $this->container->get($constraint->getService());
} else {
$service = $constraint->getService();
}
$function = array($service, $constraint->getMethod());
}
call_user_func($function, $errorElement, $value);
}
}
}
namespace Sonata\MediaBundle\CDN
{
interface CDNInterface
{
const STATUS_OK = 1;
const STATUS_TO_SEND = 2;
const STATUS_TO_FLUSH = 3;
const STATUS_ERROR = 4;
const STATUS_WAITING = 5;
public function getPath($relativePath, $isFlushable);
public function flush($string);
public function flushByString($string);
public function flushPaths(array $paths);
}
}
namespace Sonata\MediaBundle\CDN
{
class Fallback implements CDNInterface
{
protected $cdn;
protected $fallback;
public function __construct(CDNInterface $cdn, CDNInterface $fallback)
{
$this->cdn = $cdn;
$this->fallback = $fallback;
}
public function getPath($relativePath, $isFlushable)
{
if ($isFlushable) {
return $this->fallback->getPath($relativePath, $isFlushable);
}
return $this->cdn->getPath($relativePath, $isFlushable);
}
public function flushByString($string)
{
$this->cdn->flushByString($string);
}
public function flush($string)
{
$this->cdn->flush($string);
}
public function flushPaths(array $paths)
{
$this->cdn->flushPaths($paths);
}
}
}
namespace Sonata\MediaBundle\CDN
{
class PantherPortal implements CDNInterface
{
protected $path;
protected $username;
protected $password;
protected $siteId;
protected $client;
protected $wsdl;
public function __construct($path, $username, $password, $siteId, $wsdl ='https://pantherportal.cdnetworks.com/wsdl/flush.wsdl')
{
$this->path = $path;
$this->username = $username;
$this->password = $password;
$this->siteId = $siteId;
$this->wsdl = $wsdl;
}
public function getPath($relativePath, $isFlushable)
{
return sprintf('%s/%s', $this->path, $relativePath);
}
public function flushByString($string)
{
$this->flushPaths(array($string));
}
public function flush($string)
{
$this->flushPaths(array($string));
}
public function flushPaths(array $paths)
{
$result = $this->getClient()->flush($this->username, $this->password,'paths', $this->siteId, implode("\n", $paths), true, false);
if ($result !='Flush successfully submitted.') {
throw new \RuntimeException('Unable to flush : '.$result);
}
}
private function getClient()
{
if (!$this->client) {
$this->client = new \SoapClient($this->wsdl);
}
return $this->client;
}
public function setClient($client)
{
$this->client = $client;
}
}
}
namespace Sonata\MediaBundle\CDN
{
class Server implements CDNInterface
{
protected $path;
public function __construct($path)
{
$this->path = $path;
}
public function getPath($relativePath, $isFlushable)
{
return sprintf('%s/%s', rtrim($this->path,'/'), ltrim($relativePath,'/'));
}
public function flushByString($string)
{
}
public function flush($string)
{
}
public function flushPaths(array $paths)
{
}
}
}
namespace Sonata\MediaBundle\Extra
{
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Model\MediaManagerInterface;
use Sonata\MediaBundle\Provider\Pool;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Templating\EngineInterface;
class Pixlr
{
protected $referrer;
protected $secret;
protected $mediaManager;
protected $router;
protected $pool;
protected $templating;
protected $container;
protected $validFormats;
protected $allowEreg;
public function __construct($referrer, $secret, Pool $pool, MediaManagerInterface $mediaManager, RouterInterface $router, EngineInterface $templating, ContainerInterface $container)
{
$this->referrer = $referrer;
$this->secret = $secret;
$this->mediaManager = $mediaManager;
$this->router = $router;
$this->pool = $pool;
$this->templating = $templating;
$this->container = $container;
$this->validFormats = array('jpg','jpeg','png');
$this->allowEreg ='@http://([a-zA-Z0-9]*).pixlr.com/_temp/[0-9a-z]{24}\.[a-z]*@';
}
private function generateHash(MediaInterface $media)
{
return sha1($media->getId().$media->getCreatedAt()->format('u').$this->secret);
}
private function getMedia($id)
{
$media = $this->mediaManager->findOneBy(array('id'=> $id));
if (!$media) {
throw new NotFoundHttpException('Media not found');
}
return $media;
}
private function checkMedia($hash, MediaInterface $media)
{
if ($hash != $this->generateHash($media)) {
throw new NotFoundHttpException('Invalid hash');
}
if (!$this->isEditable($media)) {
throw new NotFoundHttpException('Media is not editable');
}
}
private function buildQuery(array $parameters = array())
{
$query = array();
foreach ($parameters as $name => $value) {
$query[] = sprintf('%s=%s', $name, $value);
}
return implode('&', $query);
}
public function editAction($id, $mode)
{
if (!in_array($mode, array('express','editor'))) {
throw new NotFoundHttpException('Invalid mode');
}
$media = $this->getMedia($id);
$provider = $this->pool->getProvider($media->getProviderName());
$hash = $this->generateHash($media);
$parameters = array('s'=>'c','referrer'=> $this->referrer,'exit'=> $this->router->generate('sonata_media_pixlr_exit', array('hash'=> $hash,'id'=> $media->getId()), true),'image'=> $provider->generatePublicUrl($media,'reference'),'title'=> $media->getName(),'target'=> $this->router->generate('sonata_media_pixlr_target', array('hash'=> $hash,'id'=> $media->getId()), true),'locktitle'=> true,'locktarget'=> true,
);
$url = sprintf('http://pixlr.com/%s/?%s', $mode, $this->buildQuery($parameters));
return new RedirectResponse($url);
}
public function exitAction($hash, $id)
{
$media = $this->getMedia($id);
$this->checkMedia($hash, $media);
return new Response($this->templating->render('SonataMediaBundle:Extra:pixlr_exit.html.twig'));
}
public function targetAction(Request $request, $hash, $id)
{
$media = $this->getMedia($id);
$this->checkMedia($hash, $media);
$provider = $this->pool->getProvider($media->getProviderName());
if (!preg_match($this->allowEreg, $request->get('image'), $matches)) {
throw new NotFoundHttpException(sprintf('Invalid image host : %s', $request->get('image')));
}
$file = $provider->getReferenceFile($media);
$file->setContent(file_get_contents($request->get('image')));
$provider->updateMetadata($media);
$provider->generateThumbnails($media);
$this->mediaManager->save($media);
return new Response($this->templating->render('SonataMediaBundle:Extra:pixlr_exit.html.twig'));
}
public function isEditable(MediaInterface $media)
{
if (!$this->container->get('sonata.media.admin.media')->isGranted('EDIT', $media)) {
return false;
}
return in_array(strtolower($media->getExtension()), $this->validFormats);
}
public function openEditorAction($id)
{
$media = $this->getMedia($id);
if (!$this->isEditable($media)) {
throw new NotFoundHttpException('The media is not editable');
}
return new Response($this->templating->render('SonataMediaBundle:Extra:pixlr_editor.html.twig', array('media'=> $media,'admin_pool'=> $this->container->get('sonata.admin.pool'),
)));
}
}
}
namespace Gaufrette\Adapter
{
interface MimeTypeProvider
{
public function mimeType($key);
}
}
namespace Gaufrette\Adapter
{
interface SizeCalculator
{
public function size($key);
}
}
namespace Gaufrette\Adapter
{
interface ChecksumCalculator
{
public function checksum($key);
}
}
namespace Gaufrette\Adapter
{
interface StreamFactory
{
public function createStream($key);
}
}
namespace Gaufrette
{
interface Adapter
{
public function read($key);
public function write($key, $content);
public function exists($key);
public function keys();
public function mtime($key);
public function delete($key);
public function rename($sourceKey, $targetKey);
public function isDirectory($key);
}
}
namespace Gaufrette\Adapter
{
use Gaufrette\Util;
use Gaufrette\Adapter;
use Gaufrette\Stream;
use Gaufrette\Adapter\StreamFactory;
use Gaufrette\Exception;
class Local implements Adapter,
StreamFactory,
ChecksumCalculator,
SizeCalculator,
MimeTypeProvider
{
protected $directory;
private $create;
private $mode;
public function __construct($directory, $create = false, $mode = 0777)
{
$this->directory = Util\Path::normalize($directory);
if (is_link($this->directory)) {
$this->directory = realpath($this->directory);
}
$this->create = $create;
$this->mode = $mode;
}
public function read($key)
{
return file_get_contents($this->computePath($key));
}
public function write($key, $content)
{
$path = $this->computePath($key);
$this->ensureDirectoryExists(dirname($path), true);
return file_put_contents($path, $content);
}
public function rename($sourceKey, $targetKey)
{
$targetPath = $this->computePath($targetKey);
$this->ensureDirectoryExists(dirname($targetPath), true);
return rename($this->computePath($sourceKey), $targetPath);
}
public function exists($key)
{
return file_exists($this->computePath($key));
}
public function keys()
{
$this->ensureDirectoryExists($this->directory, $this->create);
try {
$files = new \RecursiveIteratorIterator(
new \RecursiveDirectoryIterator(
$this->directory,
\FilesystemIterator::SKIP_DOTS | \FilesystemIterator::UNIX_PATHS
),
\RecursiveIteratorIterator::CHILD_FIRST
);
} catch (\Exception $e) {
$files = new \EmptyIterator;
}
$keys = array();
foreach ($files as $file) {
$keys[] = $this->computeKey($file);
}
sort($keys);
return $keys;
}
public function mtime($key)
{
return filemtime($this->computePath($key));
}
public function delete($key)
{
if ($this->isDirectory($key)) {
return rmdir($this->computePath($key));
}
return unlink($this->computePath($key));
}
public function isDirectory($key)
{
return is_dir($this->computePath($key));
}
public function createStream($key)
{
return new Stream\Local($this->computePath($key));
}
public function checksum($key)
{
return Util\Checksum::fromFile($this->computePath($key));
}
public function size($key)
{
return Util\Size::fromFile($this->computePath($key));
}
public function mimeType($key)
{
$fileInfo = new \finfo(FILEINFO_MIME_TYPE);
return $fileInfo->file($this->computePath($key));
}
public function computeKey($path)
{
$path = $this->normalizePath($path);
return ltrim(substr($path, strlen($this->directory)),'/');
}
protected function computePath($key)
{
$this->ensureDirectoryExists($this->directory, $this->create);
return $this->normalizePath($this->directory .'/'. $key);
}
protected function normalizePath($path)
{
$path = Util\Path::normalize($path);
if (0 !== strpos($path, $this->directory)) {
throw new \OutOfBoundsException(sprintf('The path "%s" is out of the filesystem.', $path));
}
return $path;
}
protected function ensureDirectoryExists($directory, $create = false)
{
if (!is_dir($directory)) {
if (!$create) {
throw new \RuntimeException(sprintf('The directory "%s" does not exist.', $directory));
}
$this->createDirectory($directory);
}
}
protected function createDirectory($directory)
{
$created = mkdir($directory, $this->mode, true);
if (!$created) {
if (!is_dir($directory)) {
throw new \RuntimeException(sprintf('The directory \'%s\' could not be created.', $directory));
}
}
}
}
}
namespace Sonata\MediaBundle\Filesystem
{
use Gaufrette\Adapter\Local as BaseLocal;
class Local extends BaseLocal
{
public function getDirectory()
{
return $this->directory;
}
}
}
namespace Gaufrette\Adapter
{
interface MetadataSupporter
{
public function setMetadata($key, $content);
public function getMetadata($key);
}
}
namespace Sonata\MediaBundle\Filesystem
{
use Gaufrette\Adapter as AdapterInterface;
use Gaufrette\Adapter\MetadataSupporter;
use Gaufrette\Filesystem;
use Psr\Log\LoggerInterface;
class Replicate implements AdapterInterface, MetadataSupporter
{
protected $master;
protected $slave;
protected $logger;
public function __construct(AdapterInterface $master, AdapterInterface $slave, LoggerInterface $logger = null)
{
$this->master = $master;
$this->slave = $slave;
$this->logger = $logger;
}
public function delete($key)
{
$ok = true;
try {
$this->slave->delete($key);
} catch (\Exception $e) {
if ($this->logger) {
$this->logger->critical(sprintf('Unable to delete %s, error: %s', $key, $e->getMessage()));
}
$ok = false;
}
try {
$this->master->delete($key);
} catch (\Exception $e) {
if ($this->logger) {
$this->logger->critical(sprintf('Unable to delete %s, error: %s', $key, $e->getMessage()));
}
$ok = false;
}
return $ok;
}
public function mtime($key)
{
return $this->master->mtime($key);
}
public function keys()
{
return $this->master->keys();
}
public function exists($key)
{
return $this->master->exists($key);
}
public function write($key, $content, array $metadata = null)
{
$ok = true;
$return = false;
try {
$return = $this->master->write($key, $content, $metadata);
} catch (\Exception $e) {
if ($this->logger) {
$this->logger->critical(sprintf('Unable to write %s, error: %s', $key, $e->getMessage()));
}
$ok = false;
}
try {
$return = $this->slave->write($key, $content, $metadata);
} catch (\Exception $e) {
if ($this->logger) {
$this->logger->critical(sprintf('Unable to write %s, error: %s', $key, $e->getMessage()));
}
$ok = false;
}
return $ok && $return;
}
public function read($key)
{
return $this->master->read($key);
}
public function rename($key, $new)
{
$ok = true;
try {
$this->master->rename($key, $new);
} catch (\Exception $e) {
if ($this->logger) {
$this->logger->critical(sprintf('Unable to rename %s, error: %s', $key, $e->getMessage()));
}
$ok = false;
}
try {
$this->slave->rename($key, $new);
} catch (\Exception $e) {
if ($this->logger) {
$this->logger->critical(sprintf('Unable to rename %s, error: %s', $key, $e->getMessage()));
}
$ok = false;
}
return $ok;
}
public function supportsMetadata()
{
return $this->master instanceof MetadataSupporter || $this->slave instanceof MetadataSupporter;
}
public function setMetadata($key, $metadata)
{
if ($this->master instanceof MetadataSupporter) {
$this->master->setMetadata($key, $metadata);
}
if ($this->slave instanceof MetadataSupporter) {
$this->slave->setMetadata($key, $metadata);
}
}
public function getMetadata($key)
{
if ($this->master instanceof MetadataSupporter) {
return $this->master->getMetadata($key);
} elseif ($this->slave instanceof MetadataSupporter) {
return $this->slave->getMetadata($key);
}
return array();
}
public function getAdapterClassNames()
{
return array(
get_class($this->master),
get_class($this->slave),
);
}
public function createFile($key, Filesystem $filesystem)
{
return $this->master->createFile($key, $filesystem);
}
public function createFileStream($key, Filesystem $filesystem)
{
return $this->master->createFileStream($key, $filesystem);
}
public function listDirectory($directory ='')
{
return $this->master->listDirectory($directory);
}
public function isDirectory($key)
{
return $this->master->isDirectory($key);
}
}
}
namespace Sonata\MediaBundle\Generator
{
use Sonata\MediaBundle\Model\MediaInterface;
interface GeneratorInterface
{
public function generatePath(MediaInterface $media);
}
}
namespace Sonata\MediaBundle\Generator
{
use Sonata\MediaBundle\Model\MediaInterface;
class DefaultGenerator implements GeneratorInterface
{
protected $firstLevel;
protected $secondLevel;
public function __construct($firstLevel = 100000, $secondLevel = 1000)
{
$this->firstLevel = $firstLevel;
$this->secondLevel = $secondLevel;
}
public function generatePath(MediaInterface $media)
{
$rep_first_level = (int) ($media->getId() / $this->firstLevel);
$rep_second_level = (int) (($media->getId() - ($rep_first_level * $this->firstLevel)) / $this->secondLevel);
return sprintf('%s/%04s/%02s', $media->getContext(), $rep_first_level + 1, $rep_second_level + 1);
}
}
}
namespace Sonata\MediaBundle\Generator
{
use Sonata\MediaBundle\Model\MediaInterface;
class ODMGenerator implements GeneratorInterface
{
public function generatePath(MediaInterface $media)
{
$id = $media->getId();
return sprintf('%s/%04s/%02s', $media->getContext(), substr($id, 0, 4), substr($id, 4, 2));
}
}
}
namespace Sonata\MediaBundle\Generator
{
use Sonata\MediaBundle\Model\MediaInterface;
class PHPCRGenerator implements GeneratorInterface
{
public function generatePath(MediaInterface $media)
{
$segments = preg_split('#/#', $media->getId(), null, PREG_SPLIT_NO_EMPTY);
if (count($segments) > 1) {
array_pop($segments);
$path = implode($segments,'/');
} else {
$path ='';
}
return $path ? sprintf('%s/%s', $media->getContext(), $path) : $media->getContext();
}
}
}
namespace Sonata\MediaBundle\Metadata
{
use Sonata\MediaBundle\Model\MediaInterface;
interface MetadataBuilderInterface
{
public function get(MediaInterface $media, $filename);
}
}
namespace Sonata\MediaBundle\Metadata
{
use Aws\S3\Enum\CannedAcl;
use Aws\S3\Enum\Storage;
use Guzzle\Http\Mimetypes;
use Sonata\MediaBundle\Model\MediaInterface;
class AmazonMetadataBuilder implements MetadataBuilderInterface
{
protected $settings;
protected $acl = array('private'=> CannedAcl::PRIVATE_ACCESS,'public'=> CannedAcl::PUBLIC_READ,'open'=> CannedAcl::PUBLIC_READ_WRITE,'auth_read'=> CannedAcl::AUTHENTICATED_READ,'owner_read'=> CannedAcl::BUCKET_OWNER_READ,'owner_full_control'=> CannedAcl::BUCKET_OWNER_FULL_CONTROL,
);
public function __construct(array $settings)
{
$this->settings = $settings;
}
protected function getDefaultMetadata()
{
$output = array();
if (isset($this->settings['acl']) && !empty($this->settings['acl'])) {
$output['ACL'] = $this->acl[$this->settings['acl']];
}
if (isset($this->settings['storage'])) {
if ($this->settings['storage'] =='standard') {
$output['storage'] = Storage::STANDARD;
} elseif ($this->settings['storage'] =='reduced') {
$output['storage'] = Storage::REDUCED;
}
}
if (isset($this->settings['meta']) && !empty($this->settings['meta'])) {
$output['meta'] = $this->settings['meta'];
}
if (isset($this->settings['cache_control']) && !empty($this->settings['cache_control'])) {
$output['CacheControl'] = $this->settings['cache_control'];
}
if (isset($this->settings['encryption']) && !empty($this->settings['encryption'])) {
if ($this->settings['encryption'] =='aes256') {
$output['encryption'] ='AES256';
}
}
return $output;
}
protected function getContentType($filename)
{
$extension = pathinfo($filename, PATHINFO_EXTENSION);
$contentType = Mimetypes::getInstance()->fromExtension($extension);
return array('contentType'=> $contentType);
}
public function get(MediaInterface $media, $filename)
{
return array_replace_recursive(
$this->getDefaultMetadata(),
$this->getContentType($filename)
);
}
}
}
namespace Sonata\MediaBundle\Metadata
{
use Sonata\MediaBundle\Model\MediaInterface;
class NoopMetadataBuilder implements MetadataBuilderInterface
{
public function get(MediaInterface $media, $filename)
{
return array();
}
}
}
namespace Sonata\MediaBundle\Metadata
{
use Sonata\MediaBundle\Filesystem\Replicate;
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
class ProxyMetadataBuilder implements MetadataBuilderInterface
{
private $container;
private $map;
private $metadata;
public function __construct(ContainerInterface $container, array $map)
{
$this->container = $container;
$this->map = $map;
}
public function get(MediaInterface $media, $filename)
{
if (!$this->container->has($media->getProviderName())) {
return array();
}
if ($meta = $this->getAmazonBuilder($media, $filename)) {
return $meta;
}
if (!$this->container->has('sonata.media.metadata.noop')) {
return array();
}
return $this->container->get('sonata.media.metadata.noop')->get($media, $filename);
}
protected function getAmazonBuilder(MediaInterface $media, $filename)
{
$adapter = $this->container->get($media->getProviderName())->getFilesystem()->getAdapter();
if ($adapter instanceof Replicate) {
$adapterClassNames = $adapter->getAdapterClassNames();
} else {
$adapterClassNames = array(get_class($adapter));
}
if ((!in_array('Gaufrette\Adapter\AmazonS3', $adapterClassNames) && !in_array('Gaufrette\Adapter\AwsS3', $adapterClassNames)) || !$this->container->has('sonata.media.metadata.amazon')) {
return false;
}
return $this->container->get('sonata.media.metadata.amazon')->get($media, $filename);
}
}
}
namespace Sonata\MediaBundle\Model
{
interface GalleryInterface
{
public function setName($name);
public function getContext();
public function setContext($context);
public function getName();
public function setEnabled($enabled);
public function getEnabled();
public function setUpdatedAt(\DateTime $updatedAt = null);
public function getUpdatedAt();
public function setCreatedAt(\DateTime $createdAt = null);
public function getCreatedAt();
public function setDefaultFormat($defaultFormat);
public function getDefaultFormat();
public function setGalleryHasMedias($galleryHasMedias);
public function getGalleryHasMedias();
public function addGalleryHasMedias(GalleryHasMediaInterface $galleryHasMedia);
public function __toString();
}
}
namespace Sonata\MediaBundle\Model
{
use Doctrine\Common\Collections\ArrayCollection;
abstract class Gallery implements GalleryInterface
{
protected $context;
protected $name;
protected $enabled;
protected $updatedAt;
protected $createdAt;
protected $defaultFormat;
protected $galleryHasMedias;
public function setName($name)
{
$this->name = $name;
}
public function getName()
{
return $this->name;
}
public function setEnabled($enabled)
{
$this->enabled = $enabled;
}
public function getEnabled()
{
return $this->enabled;
}
public function setUpdatedAt(\DateTime $updatedAt = null)
{
$this->updatedAt = $updatedAt;
}
public function getUpdatedAt()
{
return $this->updatedAt;
}
public function setCreatedAt(\DateTime $createdAt = null)
{
$this->createdAt = $createdAt;
}
public function getCreatedAt()
{
return $this->createdAt;
}
public function setDefaultFormat($defaultFormat)
{
$this->defaultFormat = $defaultFormat;
}
public function getDefaultFormat()
{
return $this->defaultFormat;
}
public function setGalleryHasMedias($galleryHasMedias)
{
$this->galleryHasMedias = new ArrayCollection();
foreach ($galleryHasMedias as $galleryHasMedia) {
$this->addGalleryHasMedias($galleryHasMedia);
}
}
public function getGalleryHasMedias()
{
return $this->galleryHasMedias;
}
public function addGalleryHasMedias(GalleryHasMediaInterface $galleryHasMedia)
{
$galleryHasMedia->setGallery($this);
$this->galleryHasMedias[] = $galleryHasMedia;
}
public function __toString()
{
return $this->getName() ?:'-';
}
public function setContext($context)
{
$this->context = $context;
}
public function getContext()
{
return $this->context;
}
}
}
namespace Sonata\MediaBundle\Model
{
interface GalleryHasMediaInterface
{
public function setEnabled($enabled);
public function getEnabled();
public function setGallery(GalleryInterface $gallery = null);
public function getGallery();
public function setMedia(MediaInterface $media = null);
public function getMedia();
public function setPosition($position);
public function getPosition();
public function setUpdatedAt(\DateTime $updatedAt = null);
public function getUpdatedAt();
public function setCreatedAt(\DateTime $createdAt = null);
public function getCreatedAt();
public function __toString();
}
}
namespace Sonata\MediaBundle\Model
{
abstract class GalleryHasMedia implements GalleryHasMediaInterface
{
protected $media;
protected $gallery;
protected $position;
protected $updatedAt;
protected $createdAt;
protected $enabled;
public function __construct()
{
$this->position = 0;
$this->enabled = false;
}
public function setCreatedAt(\DateTime $createdAt = null)
{
$this->createdAt = $createdAt;
}
public function getCreatedAt()
{
return $this->createdAt;
}
public function setEnabled($enabled)
{
$this->enabled = $enabled;
}
public function getEnabled()
{
return $this->enabled;
}
public function setGallery(GalleryInterface $gallery = null)
{
$this->gallery = $gallery;
}
public function getGallery()
{
return $this->gallery;
}
public function setMedia(MediaInterface $media = null)
{
$this->media = $media;
}
public function getMedia()
{
return $this->media;
}
public function setPosition($position)
{
$this->position = $position;
}
public function getPosition()
{
return $this->position;
}
public function setUpdatedAt(\DateTime $updatedAt = null)
{
$this->updatedAt = $updatedAt;
}
public function getUpdatedAt()
{
return $this->updatedAt;
}
public function __toString()
{
return $this->getGallery().' | '.$this->getMedia();
}
}
}
namespace Sonata\MediaBundle\Model
{
use Sonata\CoreBundle\Model\ManagerInterface;
interface GalleryManagerInterface extends ManagerInterface
{
}
}
namespace Sonata\MediaBundle\Model
{
abstract class GalleryManager implements GalleryManagerInterface
{
public function create()
{
$class = $this->getClass();
return new $class();
}
}
}
namespace Sonata\MediaBundle\Model
{
interface MediaInterface
{
const STATUS_OK = 1;
const STATUS_SENDING = 2;
const STATUS_PENDING = 3;
const STATUS_ERROR = 4;
const STATUS_ENCODING = 5;
public function setBinaryContent($binaryContent);
public function getBinaryContent();
public function getMetadataValue($name, $default = null);
public function setMetadataValue($name, $value);
public function unsetMetadataValue($name);
public function getId();
public function setName($name);
public function getName();
public function setDescription($description);
public function getDescription();
public function setEnabled($enabled);
public function getEnabled();
public function setProviderName($providerName);
public function getProviderName();
public function setProviderStatus($providerStatus);
public function getProviderStatus();
public function setProviderReference($providerReference);
public function getProviderReference();
public function setProviderMetadata(array $providerMetadata = array());
public function getProviderMetadata();
public function setWidth($width);
public function getWidth();
public function setHeight($height);
public function getHeight();
public function setLength($length);
public function getLength();
public function setCopyright($copyright);
public function getCopyright();
public function setAuthorName($authorName);
public function getAuthorName();
public function setContext($context);
public function getContext();
public function setCdnIsFlushable($cdnIsFlushable);
public function getCdnIsFlushable();
public function setCdnFlushAt(\Datetime $cdnFlushAt = null);
public function getCdnFlushAt();
public function setUpdatedAt(\Datetime $updatedAt = null);
public function getUpdatedAt();
public function setCreatedAt(\Datetime $createdAt = null);
public function getCreatedAt();
public function setContentType($contentType);
public function getExtension();
public function getContentType();
public function setSize($size);
public function getSize();
public function setCdnStatus($cdnStatus);
public function getCdnStatus();
public function getBox();
public function setGalleryHasMedias($galleryHasMedias);
public function getGalleryHasMedias();
public function getPreviousProviderReference();
}
}
namespace Sonata\MediaBundle\Model
{
use Imagine\Image\Box;
use Symfony\Component\Validator\ExecutionContextInterface;
abstract class Media implements MediaInterface
{
protected $name;
protected $description;
protected $enabled = false;
protected $providerName;
protected $providerStatus;
protected $providerReference;
protected $providerMetadata = array();
protected $width;
protected $height;
protected $length;
protected $copyright;
protected $authorName;
protected $context;
protected $cdnIsFlushable;
protected $cdnFlushAt;
protected $cdnStatus;
protected $updatedAt;
protected $createdAt;
protected $binaryContent;
protected $previousProviderReference;
protected $contentType;
protected $size;
protected $galleryHasMedias;
public function prePersist()
{
$this->setCreatedAt(new \DateTime());
$this->setUpdatedAt(new \DateTime());
}
public function preUpdate()
{
$this->setUpdatedAt(new \DateTime());
}
public static function getStatusList()
{
return array(
self::STATUS_OK =>'ok',
self::STATUS_SENDING =>'sending',
self::STATUS_PENDING =>'pending',
self::STATUS_ERROR =>'error',
self::STATUS_ENCODING =>'encoding',
);
}
public function setBinaryContent($binaryContent)
{
$this->previousProviderReference = $this->providerReference;
$this->providerReference = null;
$this->binaryContent = $binaryContent;
}
public function getBinaryContent()
{
return $this->binaryContent;
}
public function getMetadataValue($name, $default = null)
{
$metadata = $this->getProviderMetadata();
return isset($metadata[$name]) ? $metadata[$name] : $default;
}
public function setMetadataValue($name, $value)
{
$metadata = $this->getProviderMetadata();
$metadata[$name] = $value;
$this->setProviderMetadata($metadata);
}
public function unsetMetadataValue($name)
{
$metadata = $this->getProviderMetadata();
unset($metadata[$name]);
$this->setProviderMetadata($metadata);
}
public function setName($name)
{
$this->name = $name;
}
public function getName()
{
return $this->name;
}
public function setDescription($description)
{
$this->description = $description;
}
public function getDescription()
{
return $this->description;
}
public function setEnabled($enabled)
{
$this->enabled = $enabled;
}
public function getEnabled()
{
return $this->enabled;
}
public function setProviderName($providerName)
{
$this->providerName = $providerName;
}
public function getProviderName()
{
return $this->providerName;
}
public function setProviderStatus($providerStatus)
{
$this->providerStatus = $providerStatus;
}
public function getProviderStatus()
{
return $this->providerStatus;
}
public function setProviderReference($providerReference)
{
$this->providerReference = $providerReference;
}
public function getProviderReference()
{
return $this->providerReference;
}
public function setProviderMetadata(array $providerMetadata = array())
{
$this->providerMetadata = $providerMetadata;
}
public function getProviderMetadata()
{
return $this->providerMetadata;
}
public function setWidth($width)
{
$this->width = $width;
}
public function getWidth()
{
return $this->width;
}
public function setHeight($height)
{
$this->height = $height;
}
public function getHeight()
{
return $this->height;
}
public function setLength($length)
{
$this->length = $length;
}
public function getLength()
{
return $this->length;
}
public function setCopyright($copyright)
{
$this->copyright = $copyright;
}
public function getCopyright()
{
return $this->copyright;
}
public function setAuthorName($authorName)
{
$this->authorName = $authorName;
}
public function getAuthorName()
{
return $this->authorName;
}
public function setContext($context)
{
$this->context = $context;
}
public function getContext()
{
return $this->context;
}
public function setCdnIsFlushable($cdnIsFlushable)
{
$this->cdnIsFlushable = $cdnIsFlushable;
}
public function getCdnIsFlushable()
{
return $this->cdnIsFlushable;
}
public function setCdnFlushAt(\DateTime $cdnFlushAt = null)
{
$this->cdnFlushAt = $cdnFlushAt;
}
public function getCdnFlushAt()
{
return $this->cdnFlushAt;
}
public function setUpdatedAt(\DateTime $updatedAt = null)
{
$this->updatedAt = $updatedAt;
}
public function getUpdatedAt()
{
return $this->updatedAt;
}
public function setCreatedAt(\DateTime $createdAt = null)
{
$this->createdAt = $createdAt;
}
public function getCreatedAt()
{
return $this->createdAt;
}
public function setContentType($contentType)
{
$this->contentType = $contentType;
}
public function getContentType()
{
return $this->contentType;
}
public function getExtension()
{
return pathinfo($this->getProviderReference(), PATHINFO_EXTENSION);
}
public function setSize($size)
{
$this->size = $size;
}
public function getSize()
{
return $this->size;
}
public function setCdnStatus($cdnStatus)
{
$this->cdnStatus = $cdnStatus;
}
public function getCdnStatus()
{
return $this->cdnStatus;
}
public function getBox()
{
return new Box($this->width, $this->height);
}
public function __toString()
{
return $this->getName() ?:'n/a';
}
public function setGalleryHasMedias($galleryHasMedias)
{
$this->galleryHasMedias = $galleryHasMedias;
}
public function getGalleryHasMedias()
{
return $this->galleryHasMedias;
}
public function getPreviousProviderReference()
{
return $this->previousProviderReference;
}
public function isStatusErroneous(ExecutionContextInterface $context)
{
if ($this->getBinaryContent() && $this->getProviderStatus() == self::STATUS_ERROR) {
$context->addViolationAt('binaryContent','invalid', array(), null);
}
}
}
}
namespace Sonata\MediaBundle\Model
{
use Sonata\CoreBundle\Model\ManagerInterface;
interface MediaManagerInterface extends ManagerInterface
{
}
}
namespace Sonata\MediaBundle\Provider
{
use Gaufrette\Filesystem;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\CoreBundle\Model\MetadataInterface;
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Resizer\ResizerInterface;
use Symfony\Component\Form\FormBuilder;
interface MediaProviderInterface
{
public function addFormat($name, $format);
public function getFormat($name);
public function requireThumbnails();
public function generateThumbnails(MediaInterface $media);
public function removeThumbnails(MediaInterface $media);
public function getReferenceFile(MediaInterface $media);
public function getFormatName(MediaInterface $media, $format);
public function getReferenceImage(MediaInterface $media);
public function preUpdate(MediaInterface $media);
public function postUpdate(MediaInterface $media);
public function preRemove(MediaInterface $media);
public function postRemove(MediaInterface $media);
public function buildCreateForm(FormMapper $formMapper);
public function buildEditForm(FormMapper $formMapper);
public function prePersist(MediaInterface $media);
public function postPersist(MediaInterface $media);
public function getHelperProperties(MediaInterface $media, $format);
public function generatePath(MediaInterface $media);
public function generatePublicUrl(MediaInterface $media, $format);
public function generatePrivateUrl(MediaInterface $media, $format);
public function getFormats();
public function setName($name);
public function getName();
public function getProviderMetadata();
public function setTemplates(array $templates);
public function getTemplates();
public function getTemplate($name);
public function getDownloadResponse(MediaInterface $media, $format, $mode, array $headers = array());
public function getResizer();
public function getFilesystem();
public function getCdnPath($relativePath, $isFlushable);
public function transform(MediaInterface $media);
public function validate(ErrorElement $errorElement, MediaInterface $media);
public function buildMediaType(FormBuilder $formBuilder);
public function updateMetadata(MediaInterface $media, $force = false);
}
}
namespace Sonata\MediaBundle\Provider
{
use Gaufrette\Filesystem;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\CoreBundle\Model\Metadata;
use Sonata\MediaBundle\CDN\CDNInterface;
use Sonata\MediaBundle\Generator\GeneratorInterface;
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Resizer\ResizerInterface;
use Sonata\MediaBundle\Thumbnail\ThumbnailInterface;
abstract class BaseProvider implements MediaProviderInterface
{
protected $formats = array();
protected $templates = array();
protected $resizer;
protected $filesystem;
protected $pathGenerator;
protected $cdn;
protected $thumbnail;
public function __construct($name, Filesystem $filesystem, CDNInterface $cdn, GeneratorInterface $pathGenerator, ThumbnailInterface $thumbnail)
{
$this->name = $name;
$this->filesystem = $filesystem;
$this->cdn = $cdn;
$this->pathGenerator = $pathGenerator;
$this->thumbnail = $thumbnail;
}
abstract protected function doTransform(MediaInterface $media);
final public function transform(MediaInterface $media)
{
if (null === $media->getBinaryContent()) {
return;
}
$this->doTransform($media);
}
public function addFormat($name, $format)
{
$this->formats[$name] = $format;
}
public function getFormat($name)
{
return isset($this->formats[$name]) ? $this->formats[$name] : false;
}
public function requireThumbnails()
{
return $this->getResizer() !== null;
}
public function generateThumbnails(MediaInterface $media)
{
$this->thumbnail->generate($this, $media);
}
public function removeThumbnails(MediaInterface $media)
{
$this->thumbnail->delete($this, $media);
}
public function getFormatName(MediaInterface $media, $format)
{
if ($format =='admin') {
return'admin';
}
if ($format =='reference') {
return'reference';
}
$baseName = $media->getContext().'_';
if (substr($format, 0, strlen($baseName)) == $baseName) {
return $format;
}
return $baseName.$format;
}
public function getProviderMetadata()
{
return new Metadata($this->getName(), $this->getName().'.description', false,'SonataMediaBundle', array('class'=>'fa fa-file'));
}
public function preRemove(MediaInterface $media)
{
$path = $this->getReferenceImage($media);
if ($this->getFilesystem()->has($path)) {
$this->getFilesystem()->delete($path);
}
if ($this->requireThumbnails()) {
$this->thumbnail->delete($this, $media);
}
}
public function postRemove(MediaInterface $media)
{
}
public function generatePath(MediaInterface $media)
{
return $this->pathGenerator->generatePath($media);
}
public function getFormats()
{
return $this->formats;
}
public function setName($name)
{
$this->name = $name;
}
public function getName()
{
return $this->name;
}
public function setTemplates(array $templates)
{
$this->templates = $templates;
}
public function getTemplates()
{
return $this->templates;
}
public function getTemplate($name)
{
return isset($this->templates[$name]) ? $this->templates[$name] : null;
}
public function getResizer()
{
return $this->resizer;
}
public function getFilesystem()
{
return $this->filesystem;
}
public function getCdn()
{
return $this->cdn;
}
public function getCdnPath($relativePath, $isFlushable)
{
return $this->getCdn()->getPath($relativePath, $isFlushable);
}
public function setResizer(ResizerInterface $resizer)
{
$this->resizer = $resizer;
}
public function prePersist(MediaInterface $media)
{
$media->setCreatedAt(new \Datetime());
$media->setUpdatedAt(new \Datetime());
}
public function preUpdate(MediaInterface $media)
{
$media->setUpdatedAt(new \Datetime());
}
public function validate(ErrorElement $errorElement, MediaInterface $media)
{
}
}
}
namespace Sonata\MediaBundle\Provider
{
use Buzz\Browser;
use Gaufrette\Filesystem;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Model\Metadata;
use Sonata\MediaBundle\CDN\CDNInterface;
use Sonata\MediaBundle\Generator\GeneratorInterface;
use Sonata\MediaBundle\Metadata\MetadataBuilderInterface;
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Thumbnail\ThumbnailInterface;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
abstract class BaseVideoProvider extends BaseProvider
{
protected $browser;
protected $metadata;
public function __construct($name, Filesystem $filesystem, CDNInterface $cdn, GeneratorInterface $pathGenerator, ThumbnailInterface $thumbnail, Browser $browser, MetadataBuilderInterface $metadata = null)
{
parent::__construct($name, $filesystem, $cdn, $pathGenerator, $thumbnail);
$this->browser = $browser;
$this->metadata = $metadata;
}
public function getProviderMetadata()
{
return new Metadata($this->getName(), $this->getName().'.description', null,'SonataMediaBundle', array('class'=>'fa fa-video-camera'));
}
public function getReferenceImage(MediaInterface $media)
{
return $media->getMetadataValue('thumbnail_url');
}
public function getReferenceFile(MediaInterface $media)
{
$key = $this->generatePrivateUrl($media,'reference');
if ($this->getFilesystem()->has($key)) {
$referenceFile = $this->getFilesystem()->get($key);
} else {
$referenceFile = $this->getFilesystem()->get($key, true);
$metadata = $this->metadata ? $this->metadata->get($media, $referenceFile->getName()) : array();
$referenceFile->setContent($this->browser->get($this->getReferenceImage($media))->getContent(), $metadata);
}
return $referenceFile;
}
public function generatePublicUrl(MediaInterface $media, $format)
{
return $this->getCdn()->getPath(sprintf('%s/thumb_%d_%s.jpg',
$this->generatePath($media),
$media->getId(),
$format
), $media->getCdnIsFlushable());
}
public function generatePrivateUrl(MediaInterface $media, $format)
{
return sprintf('%s/thumb_%d_%s.jpg',
$this->generatePath($media),
$media->getId(),
$format
);
}
public function buildEditForm(FormMapper $formMapper)
{
$formMapper->add('name');
$formMapper->add('enabled', null, array('required'=> false));
$formMapper->add('authorName');
$formMapper->add('cdnIsFlushable');
$formMapper->add('description');
$formMapper->add('copyright');
$formMapper->add('binaryContent','text', array('required'=> false));
}
public function buildCreateForm(FormMapper $formMapper)
{
$formMapper->add('binaryContent','text', array('constraints'=> array(
new NotBlank(),
new NotNull(),
),
));
}
public function buildMediaType(FormBuilder $formBuilder)
{
$formBuilder->add('binaryContent','text');
}
public function postUpdate(MediaInterface $media)
{
$this->postPersist($media);
}
public function postPersist(MediaInterface $media)
{
if (!$media->getBinaryContent()) {
return;
}
$this->generateThumbnails($media);
}
public function postRemove(MediaInterface $media)
{
}
protected function getMetadata(MediaInterface $media, $url)
{
try {
$response = $this->browser->get($url);
} catch (\RuntimeException $e) {
throw new \RuntimeException('Unable to retrieve the video information for :'.$url, null, $e);
}
$metadata = json_decode($response->getContent(), true);
if (!$metadata) {
throw new \RuntimeException('Unable to decode the video information for :'.$url);
}
return $metadata;
}
protected function getBoxHelperProperties(MediaInterface $media, $format, $options = array())
{
if ($format =='reference') {
return $media->getBox();
}
if (isset($options['width']) || isset($options['height'])) {
$settings = array('width'=> isset($options['width']) ? $options['width'] : null,'height'=> isset($options['height']) ? $options['height'] : null,
);
} else {
$settings = $this->getFormat($format);
}
return $this->resizer->getBox($media, $settings);
}
}
}
namespace Sonata\MediaBundle\Provider
{
use Sonata\CoreBundle\Model\Metadata;
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
class DailyMotionProvider extends BaseVideoProvider
{
public function getHelperProperties(MediaInterface $media, $format, $options = array())
{
$defaults = array('related'=> 0,'explicit'=> 0,'autoPlay'=> 0,'autoMute'=> 0,'unmuteOnMouseOver'=> 0,'start'=> 0,'enableApi'=> 0,'chromeless'=> 0,'expendVideo'=> 0,'color2'=> null,'foreground'=> null,'background'=> null,'highlight'=> null,
);
$player_parameters = array_merge($defaults, isset($options['player_parameters']) ? $options['player_parameters'] : array());
$box = $this->getBoxHelperProperties($media, $format, $options);
$params = array('player_parameters'=> http_build_query($player_parameters),'allowFullScreen'=> isset($options['allowFullScreen']) ? $options['allowFullScreen'] :'true','allowScriptAccess'=> isset($options['allowScriptAccess']) ? $options['allowScriptAccess'] :'always','width'=> $box->getWidth(),'height'=> $box->getHeight(),
);
return $params;
}
public function getProviderMetadata()
{
return new Metadata($this->getName(), $this->getName().'.description','bundles/sonatamedia/dailymotion-icon.png','SonataMediaBundle');
}
protected function fixBinaryContent(MediaInterface $media)
{
if (!$media->getBinaryContent()) {
return;
}
if (preg_match("/www.dailymotion.com\/video\/([0-9a-zA-Z]*)_/", $media->getBinaryContent(), $matches)) {
$media->setBinaryContent($matches[1]);
}
}
protected function doTransform(MediaInterface $media)
{
$this->fixBinaryContent($media);
if (!$media->getBinaryContent()) {
return;
}
$media->setProviderName($this->name);
$media->setProviderStatus(MediaInterface::STATUS_OK);
$media->setProviderReference($media->getBinaryContent());
$this->updateMetadata($media, true);
}
public function updateMetadata(MediaInterface $media, $force = false)
{
$url = sprintf('http://www.dailymotion.com/services/oembed?url=http://www.dailymotion.com/video/%s&format=json', $media->getProviderReference());
try {
$metadata = $this->getMetadata($media, $url);
} catch (\RuntimeException $e) {
$media->setEnabled(false);
$media->setProviderStatus(MediaInterface::STATUS_ERROR);
return;
}
$media->setProviderMetadata($metadata);
if ($force) {
$media->setName($metadata['title']);
$media->setAuthorName($metadata['author_name']);
}
$media->setHeight($metadata['height']);
$media->setWidth($metadata['width']);
}
public function getDownloadResponse(MediaInterface $media, $format, $mode, array $headers = array())
{
return new RedirectResponse(sprintf('http://www.dailymotion.com/video/%s', $media->getProviderReference()), 302, $headers);
}
}
}
namespace Sonata\MediaBundle\Provider
{
use Gaufrette\Filesystem;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\CoreBundle\Model\Metadata;
use Sonata\MediaBundle\CDN\CDNInterface;
use Sonata\MediaBundle\Generator\GeneratorInterface;
use Sonata\MediaBundle\Metadata\MetadataBuilderInterface;
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Thumbnail\ThumbnailInterface;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
class FileProvider extends BaseProvider
{
protected $allowedExtensions;
protected $allowedMimeTypes;
protected $metadata;
public function __construct($name, Filesystem $filesystem, CDNInterface $cdn, GeneratorInterface $pathGenerator, ThumbnailInterface $thumbnail, array $allowedExtensions = array(), array $allowedMimeTypes = array(), MetadataBuilderInterface $metadata = null)
{
parent::__construct($name, $filesystem, $cdn, $pathGenerator, $thumbnail);
$this->allowedExtensions = $allowedExtensions;
$this->allowedMimeTypes = $allowedMimeTypes;
$this->metadata = $metadata;
}
public function getProviderMetadata()
{
return new Metadata($this->getName(), $this->getName().'.description', false,'SonataMediaBundle', array('class'=>'fa fa-file-text-o'));
}
public function getReferenceImage(MediaInterface $media)
{
return sprintf('%s/%s',
$this->generatePath($media),
$media->getProviderReference()
);
}
public function getReferenceFile(MediaInterface $media)
{
return $this->getFilesystem()->get($this->getReferenceImage($media), true);
}
public function buildEditForm(FormMapper $formMapper)
{
$formMapper->add('name');
$formMapper->add('enabled', null, array('required'=> false));
$formMapper->add('authorName');
$formMapper->add('cdnIsFlushable');
$formMapper->add('description');
$formMapper->add('copyright');
$formMapper->add('binaryContent','file', array('required'=> false));
}
public function buildCreateForm(FormMapper $formMapper)
{
$formMapper->add('binaryContent','file', array('constraints'=> array(
new NotBlank(),
new NotNull(),
),
));
}
public function buildMediaType(FormBuilder $formBuilder)
{
$formBuilder->add('binaryContent','file');
}
public function postPersist(MediaInterface $media)
{
if ($media->getBinaryContent() === null) {
return;
}
$this->setFileContents($media);
$this->generateThumbnails($media);
}
public function postUpdate(MediaInterface $media)
{
if (!$media->getBinaryContent() instanceof \SplFileInfo) {
return;
}
$oldMedia = clone $media;
if ($media->getPreviousProviderReference() !== null) {
$oldMedia->setProviderReference($media->getPreviousProviderReference());
$path = $this->getReferenceImage($oldMedia);
if ($this->getFilesystem()->has($path)) {
$this->getFilesystem()->delete($path);
}
}
$this->fixBinaryContent($media);
$this->setFileContents($media);
$this->generateThumbnails($media);
}
protected function fixBinaryContent(MediaInterface $media)
{
if ($media->getBinaryContent() === null) {
return;
}
if (!$media->getBinaryContent() instanceof File) {
if (!is_file($media->getBinaryContent())) {
throw new \RuntimeException('The file does not exist : '.$media->getBinaryContent());
}
$binaryContent = new File($media->getBinaryContent());
$media->setBinaryContent($binaryContent);
}
}
protected function fixFilename(MediaInterface $media)
{
if ($media->getBinaryContent() instanceof UploadedFile) {
$media->setName($media->getName() ?: $media->getBinaryContent()->getClientOriginalName());
$media->setMetadataValue('filename', $media->getBinaryContent()->getClientOriginalName());
} elseif ($media->getBinaryContent() instanceof File) {
$media->setName($media->getName() ?: $media->getBinaryContent()->getBasename());
$media->setMetadataValue('filename', $media->getBinaryContent()->getBasename());
}
if (!$media->getName()) {
throw new \RuntimeException('Please define a valid media\'s name');
}
}
protected function doTransform(MediaInterface $media)
{
$this->fixBinaryContent($media);
$this->fixFilename($media);
if (!$media->getProviderReference()) {
$media->setProviderReference($this->generateReferenceName($media));
}
if ($media->getBinaryContent()) {
$media->setContentType($media->getBinaryContent()->getMimeType());
$media->setSize($media->getBinaryContent()->getSize());
}
$media->setProviderStatus(MediaInterface::STATUS_OK);
}
public function updateMetadata(MediaInterface $media, $force = true)
{
$path = tempnam(sys_get_temp_dir(),'sonata_update_metadata');
$fileObject = new \SplFileObject($path,'w');
$fileObject->fwrite($this->getReferenceFile($media)->getContent());
$media->setSize($fileObject->getSize());
}
public function generatePublicUrl(MediaInterface $media, $format)
{
if ($format =='reference') {
$path = $this->getReferenceImage($media);
} else {
$path = sprintf('sonatamedia/files/%s/file.png', $format);
}
return $this->getCdn()->getPath($path, $media->getCdnIsFlushable());
}
public function getHelperProperties(MediaInterface $media, $format, $options = array())
{
return array_merge(array('title'=> $media->getName(),'thumbnail'=> $this->getReferenceImage($media),'file'=> $this->getReferenceImage($media),
), $options);
}
public function generatePrivateUrl(MediaInterface $media, $format)
{
if ($format =='reference') {
return $this->getReferenceImage($media);
}
return false;
}
protected function setFileContents(MediaInterface $media, $contents = null)
{
$file = $this->getFilesystem()->get(sprintf('%s/%s', $this->generatePath($media), $media->getProviderReference()), true);
if (!$contents) {
$contents = $media->getBinaryContent()->getRealPath();
}
$metadata = $this->metadata ? $this->metadata->get($media, $file->getName()) : array();
$file->setContent(file_get_contents($contents), $metadata);
}
protected function generateReferenceName(MediaInterface $media)
{
return sha1($media->getName().rand(11111, 99999)).'.'.$media->getBinaryContent()->guessExtension();
}
public function getDownloadResponse(MediaInterface $media, $format, $mode, array $headers = array())
{
$headers = array_merge(array('Content-Type'=> $media->getContentType(),'Content-Disposition'=> sprintf('attachment; filename="%s"', $media->getMetadataValue('filename')),
), $headers);
if (!in_array($mode, array('http','X-Sendfile','X-Accel-Redirect'))) {
throw new \RuntimeException('Invalid mode provided');
}
if ($mode =='http') {
if ($format =='reference') {
$file = $this->getReferenceFile($media);
} else {
$file = $this->getFilesystem()->get($this->generatePrivateUrl($media, $format));
}
return new StreamedResponse(function () use ($file) {
echo $file->getContent();
}, 200, $headers);
}
if (!$this->getFilesystem()->getAdapter() instanceof \Sonata\MediaBundle\Filesystem\Local) {
throw new \RuntimeException('Cannot use X-Sendfile or X-Accel-Redirect with non \Sonata\MediaBundle\Filesystem\Local');
}
$filename = sprintf('%s/%s',
$this->getFilesystem()->getAdapter()->getDirectory(),
$this->generatePrivateUrl($media, $format)
);
return new BinaryFileResponse($filename, 200, $headers);
}
public function validate(ErrorElement $errorElement, MediaInterface $media)
{
if (!$media->getBinaryContent() instanceof \SplFileInfo) {
return;
}
if ($media->getBinaryContent() instanceof UploadedFile) {
$fileName = $media->getBinaryContent()->getClientOriginalName();
} elseif ($media->getBinaryContent() instanceof File) {
$fileName = $media->getBinaryContent()->getFilename();
} else {
throw new \RuntimeException(sprintf('Invalid binary content type: %s', get_class($media->getBinaryContent())));
}
if (!in_array(strtolower(pathinfo($fileName, PATHINFO_EXTENSION)), $this->allowedExtensions)) {
$errorElement
->with('binaryContent')
->addViolation('Invalid extensions')
->end();
}
if (!in_array($media->getBinaryContent()->getMimeType(), $this->allowedMimeTypes)) {
$errorElement
->with('binaryContent')
->addViolation('Invalid mime type : '.$media->getBinaryContent()->getMimeType())
->end();
}
}
}
}
namespace Sonata\MediaBundle\Provider
{
use Gaufrette\Filesystem;
use Imagine\Image\ImagineInterface;
use Sonata\CoreBundle\Model\Metadata;
use Sonata\MediaBundle\CDN\CDNInterface;
use Sonata\MediaBundle\Generator\GeneratorInterface;
use Sonata\MediaBundle\Metadata\MetadataBuilderInterface;
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Thumbnail\ThumbnailInterface;
class ImageProvider extends FileProvider
{
protected $imagineAdapter;
public function __construct($name, Filesystem $filesystem, CDNInterface $cdn, GeneratorInterface $pathGenerator, ThumbnailInterface $thumbnail, array $allowedExtensions = array(), array $allowedMimeTypes = array(), ImagineInterface $adapter, MetadataBuilderInterface $metadata = null)
{
parent::__construct($name, $filesystem, $cdn, $pathGenerator, $thumbnail, $allowedExtensions, $allowedMimeTypes, $metadata);
$this->imagineAdapter = $adapter;
}
public function getProviderMetadata()
{
return new Metadata($this->getName(), $this->getName().'.description', false,'SonataMediaBundle', array('class'=>'fa fa-picture-o'));
}
public function getHelperProperties(MediaInterface $media, $format, $options = array())
{
if ($format =='reference') {
$box = $media->getBox();
} else {
$resizerFormat = $this->getFormat($format);
if ($resizerFormat === false) {
throw new \RuntimeException(sprintf('The image format "%s" is not defined.
                        Is the format registered in your ``sonata_media`` configuration?', $format));
}
$box = $this->resizer->getBox($media, $resizerFormat);
}
return array_merge(array('alt'=> $media->getName(),'title'=> $media->getName(),'src'=> $this->generatePublicUrl($media, $format),'width'=> $box->getWidth(),'height'=> $box->getHeight(),
), $options);
}
public function getReferenceImage(MediaInterface $media)
{
return sprintf('%s/%s',
$this->generatePath($media),
$media->getProviderReference()
);
}
protected function doTransform(MediaInterface $media)
{
parent::doTransform($media);
if (!is_object($media->getBinaryContent()) && !$media->getBinaryContent()) {
return;
}
try {
$image = $this->imagineAdapter->open($media->getBinaryContent()->getPathname());
} catch (\RuntimeException $e) {
$media->setProviderStatus(MediaInterface::STATUS_ERROR);
return;
}
$size = $image->getSize();
$media->setWidth($size->getWidth());
$media->setHeight($size->getHeight());
$media->setProviderStatus(MediaInterface::STATUS_OK);
}
public function updateMetadata(MediaInterface $media, $force = true)
{
try {
$path = tempnam(sys_get_temp_dir(),'sonata_update_metadata');
$fileObject = new \SplFileObject($path,'w');
$fileObject->fwrite($this->getReferenceFile($media)->getContent());
$image = $this->imagineAdapter->open($fileObject->getPathname());
$size = $image->getSize();
$media->setSize($fileObject->getSize());
$media->setWidth($size->getWidth());
$media->setHeight($size->getHeight());
} catch (\LogicException $e) {
$media->setProviderStatus(MediaInterface::STATUS_ERROR);
$media->setSize(0);
$media->setWidth(0);
$media->setHeight(0);
}
}
public function generatePublicUrl(MediaInterface $media, $format)
{
if ($format =='reference') {
$path = $this->getReferenceImage($media);
} else {
$path = $this->thumbnail->generatePublicUrl($this, $media, $format);
}
return $this->getCdn()->getPath($path, $media->getCdnIsFlushable());
}
public function generatePrivateUrl(MediaInterface $media, $format)
{
return $this->thumbnail->generatePrivateUrl($this, $media, $format);
}
}
}
namespace Sonata\MediaBundle\Provider
{
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Security\DownloadStrategyInterface;
class Pool
{
protected $providers = array();
protected $contexts = array();
protected $downloadSecurities = array();
protected $defaultContext;
public function __construct($context)
{
$this->defaultContext = $context;
}
public function getProvider($name)
{
if (!isset($this->providers[$name])) {
throw new \RuntimeException(sprintf('unable to retrieve the provider named : `%s`', $name));
}
return $this->providers[$name];
}
public function addProvider($name, MediaProviderInterface $instance)
{
$this->providers[$name] = $instance;
}
public function addDownloadSecurity($name, DownloadStrategyInterface $security)
{
$this->downloadSecurities[$name] = $security;
}
public function setProviders($providers)
{
$this->providers = $providers;
}
public function getProviders()
{
return $this->providers;
}
public function addContext($name, array $providers = array(), array $formats = array(), array $download = array())
{
if (!$this->hasContext($name)) {
$this->contexts[$name] = array('providers'=> array(),'formats'=> array(),'download'=> array(),
);
}
$this->contexts[$name]['providers'] = $providers;
$this->contexts[$name]['formats'] = $formats;
$this->contexts[$name]['download'] = $download;
}
public function hasContext($name)
{
return isset($this->contexts[$name]);
}
public function getContext($name)
{
if (!$this->hasContext($name)) {
return;
}
return $this->contexts[$name];
}
public function getContexts()
{
return $this->contexts;
}
public function getProviderNamesByContext($name)
{
$context = $this->getContext($name);
if (!$context) {
return;
}
return $context['providers'];
}
public function getFormatNamesByContext($name)
{
$context = $this->getContext($name);
if (!$context) {
return;
}
return $context['formats'];
}
public function getProvidersByContext($name)
{
$providers = array();
if (!$this->hasContext($name)) {
return $providers;
}
foreach ($this->getProviderNamesByContext($name) as $name) {
$providers[] = $this->getProvider($name);
}
return $providers;
}
public function getProviderList()
{
$choices = array();
foreach (array_keys($this->providers) as $name) {
$choices[$name] = $name;
}
return $choices;
}
public function getDownloadSecurity(MediaInterface $media)
{
$context = $this->getContext($media->getContext());
$id = $context['download']['strategy'];
if (!isset($this->downloadSecurities[$id])) {
throw new \RuntimeException('Unable to retrieve the download security : '.$id);
}
return $this->downloadSecurities[$id];
}
public function getDownloadMode(MediaInterface $media)
{
$context = $this->getContext($media->getContext());
return $context['download']['mode'];
}
public function getDefaultContext()
{
return $this->defaultContext;
}
public function validate(ErrorElement $errorElement, MediaInterface $media)
{
$provider = $this->getProvider($media->getProviderName());
$provider->validate($errorElement, $media);
}
}
}
namespace Sonata\MediaBundle\Provider
{
use Sonata\CoreBundle\Model\Metadata;
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
class VimeoProvider extends BaseVideoProvider
{
public function getHelperProperties(MediaInterface $media, $format, $options = array())
{
$defaults = array('fp_version'=> 10,'fullscreen'=> true,'title'=> true,'byline'=> 0,'portrait'=> true,'color'=> null,'hd_off'=> 0,'js_api'=> null,'js_onLoad'=> 0,'js_swf_id'=> uniqid('vimeo_player_'),
);
$player_parameters = array_merge($defaults, isset($options['player_parameters']) ? $options['player_parameters'] : array());
$box = $this->getBoxHelperProperties($media, $format, $options);
$params = array('src'=> http_build_query($player_parameters),'id'=> $player_parameters['js_swf_id'],'frameborder'=> isset($options['frameborder']) ? $options['frameborder'] : 0,'width'=> $box->getWidth(),'height'=> $box->getHeight(),
);
return $params;
}
public function getProviderMetadata()
{
return new Metadata($this->getName(), $this->getName().'.description', false,'SonataMediaBundle', array('class'=>'fa fa-vimeo-square'));
}
protected function fixBinaryContent(MediaInterface $media)
{
if (!$media->getBinaryContent()) {
return;
}
if (preg_match("/vimeo\.com\/(\d+)/", $media->getBinaryContent(), $matches)) {
$media->setBinaryContent($matches[1]);
}
}
protected function doTransform(MediaInterface $media)
{
$this->fixBinaryContent($media);
if (!$media->getBinaryContent()) {
return;
}
$media->setProviderName($this->name);
$media->setProviderReference($media->getBinaryContent());
$media->setProviderStatus(MediaInterface::STATUS_OK);
$this->updateMetadata($media, true);
}
public function updateMetadata(MediaInterface $media, $force = false)
{
$url = sprintf('http://vimeo.com/api/oembed.json?url=http://vimeo.com/%s', $media->getProviderReference());
try {
$metadata = $this->getMetadata($media, $url);
} catch (\RuntimeException $e) {
$media->setEnabled(false);
$media->setProviderStatus(MediaInterface::STATUS_ERROR);
return;
}
$media->setProviderMetadata($metadata);
if ($force) {
$media->setName($metadata['title']);
$media->setDescription($metadata['description']);
$media->setAuthorName($metadata['author_name']);
}
$media->setHeight($metadata['height']);
$media->setWidth($metadata['width']);
$media->setLength($metadata['duration']);
$media->setContentType('video/x-flv');
}
public function getDownloadResponse(MediaInterface $media, $format, $mode, array $headers = array())
{
return new RedirectResponse(sprintf('http://vimeo.com/%s', $media->getProviderReference()), 302, $headers);
}
}
}
namespace Sonata\MediaBundle\Provider
{
use Buzz\Browser;
use Gaufrette\Filesystem;
use Sonata\CoreBundle\Model\Metadata;
use Sonata\MediaBundle\CDN\CDNInterface;
use Sonata\MediaBundle\Generator\GeneratorInterface;
use Sonata\MediaBundle\Metadata\MetadataBuilderInterface;
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Thumbnail\ThumbnailInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
class YouTubeProvider extends BaseVideoProvider
{
protected $html5;
public function __construct($name, Filesystem $filesystem, CDNInterface $cdn, GeneratorInterface $pathGenerator, ThumbnailInterface $thumbnail, Browser $browser, MetadataBuilderInterface $metadata = null, $html5 = false)
{
parent::__construct($name, $filesystem, $cdn, $pathGenerator, $thumbnail, $browser, $metadata);
$this->html5 = $html5;
}
public function getProviderMetadata()
{
return new Metadata($this->getName(), $this->getName().'.description', false,'SonataMediaBundle', array('class'=>'fa fa-youtube'));
}
public function getHelperProperties(MediaInterface $media, $format, $options = array())
{
if (!isset($options['html5'])) {
$options['html5'] = $this->html5;
}
$default_player_url_parameters = array('rel'=> 0,'autoplay'=> 0,'loop'=> 0,'enablejsapi'=> 0,'playerapiid'=> null,'disablekb'=> 0,'egm'=> 0,'border'=> 0,'color1'=> null,'color2'=> null,'fs'=> 1,'start'=> 0,'hd'=> 1,'showsearch'=> 0,'showinfo'=> 0,'iv_load_policy'=> 1,'cc_load_policy'=> 1,'wmode'=>'window',
);
$default_player_parameters = array('border'=> $default_player_url_parameters['border'],'allowFullScreen'=> $default_player_url_parameters['fs'] =='1'? true : false,'allowScriptAccess'=> isset($options['allowScriptAccess']) ? $options['allowScriptAccess'] :'always','wmode'=> $default_player_url_parameters['wmode'],
);
$player_url_parameters = array_merge($default_player_url_parameters, isset($options['player_url_parameters']) ? $options['player_url_parameters'] : array());
$box = $this->getBoxHelperProperties($media, $format, $options);
$player_parameters = array_merge($default_player_parameters, isset($options['player_parameters']) ? $options['player_parameters'] : array(), array('width'=> $box->getWidth(),'height'=> $box->getHeight(),
));
$params = array('html5'=> $options['html5'],'player_url_parameters'=> http_build_query($player_url_parameters),'player_parameters'=> $player_parameters,
);
return $params;
}
protected function fixBinaryContent(MediaInterface $media)
{
if (!$media->getBinaryContent()) {
return;
}
if (preg_match("/(?<=v(\=|\/))([-a-zA-Z0-9_]+)|(?<=youtu\.be\/)([-a-zA-Z0-9_]+)/", $media->getBinaryContent(), $matches)) {
$media->setBinaryContent($matches[2]);
}
}
protected function doTransform(MediaInterface $media)
{
$this->fixBinaryContent($media);
if (!$media->getBinaryContent()) {
return;
}
$media->setProviderName($this->name);
$media->setProviderStatus(MediaInterface::STATUS_OK);
$media->setProviderReference($media->getBinaryContent());
$this->updateMetadata($media, true);
}
public function updateMetadata(MediaInterface $media, $force = false)
{
$url = sprintf('http://www.youtube.com/oembed?url=http://www.youtube.com/watch?v=%s&format=json', $media->getProviderReference());
try {
$metadata = $this->getMetadata($media, $url);
} catch (\RuntimeException $e) {
$media->setEnabled(false);
$media->setProviderStatus(MediaInterface::STATUS_ERROR);
return;
}
$media->setProviderMetadata($metadata);
if ($force) {
$media->setName($metadata['title']);
$media->setAuthorName($metadata['author_name']);
}
$media->setHeight($metadata['height']);
$media->setWidth($metadata['width']);
$media->setContentType('video/x-flv');
}
public function getDownloadResponse(MediaInterface $media, $format, $mode, array $headers = array())
{
return new RedirectResponse(sprintf('http://www.youtube.com/watch?v=%s', $media->getProviderReference()), 302, $headers);
}
}
}
namespace Sonata\MediaBundle\Resizer
{
use Gaufrette\File;
use Sonata\MediaBundle\Model\MediaInterface;
interface ResizerInterface
{
public function resize(MediaInterface $media, File $in, File $out, $format, array $settings);
public function getBox(MediaInterface $media, array $settings);
}
}
namespace Sonata\MediaBundle\Resizer
{
use Gaufrette\File;
use Imagine\Exception\InvalidArgumentException;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Imagine\Image\ImagineInterface;
use Sonata\MediaBundle\Metadata\MetadataBuilderInterface;
use Sonata\MediaBundle\Model\MediaInterface;
class SimpleResizer implements ResizerInterface
{
protected $adapter;
protected $mode;
protected $metadata;
public function __construct(ImagineInterface $adapter, $mode, MetadataBuilderInterface $metadata)
{
$this->adapter = $adapter;
$this->mode = $mode;
$this->metadata = $metadata;
}
public function resize(MediaInterface $media, File $in, File $out, $format, array $settings)
{
if (!isset($settings['width'])) {
throw new \RuntimeException(sprintf('Width parameter is missing in context "%s" for provider "%s"', $media->getContext(), $media->getProviderName()));
}
$image = $this->adapter->load($in->getContent());
$content = $image
->thumbnail($this->getBox($media, $settings), $this->mode)
->get($format, array('quality'=> $settings['quality']));
$out->setContent($content, $this->metadata->get($media, $out->getName()));
}
public function getBox(MediaInterface $media, array $settings)
{
$size = $media->getBox();
if ($settings['width'] == null && $settings['height'] == null) {
throw new \RuntimeException(sprintf('Width/Height parameter is missing in context "%s" for provider "%s". Please add at least one parameter.', $media->getContext(), $media->getProviderName()));
}
if ($settings['height'] == null) {
$settings['height'] = (int) ($settings['width'] * $size->getHeight() / $size->getWidth());
}
if ($settings['width'] == null) {
$settings['width'] = (int) ($settings['height'] * $size->getWidth() / $size->getHeight());
}
return $this->computeBox($media, $settings);
}
private function computeBox(MediaInterface $media, array $settings)
{
if ($this->mode !== ImageInterface::THUMBNAIL_INSET && $this->mode !== ImageInterface::THUMBNAIL_OUTBOUND) {
throw new InvalidArgumentException('Invalid mode specified');
}
$size = $media->getBox();
$ratios = array(
$settings['width'] / $size->getWidth(),
$settings['height'] / $size->getHeight(),
);
if ($this->mode === ImageInterface::THUMBNAIL_INSET) {
$ratio = min($ratios);
} else {
$ratio = max($ratios);
}
return $size->scale($ratio);
}
}
}
namespace Sonata\MediaBundle\Resizer
{
use Gaufrette\File;
use Imagine\Image\Box;
use Imagine\Image\ImagineInterface;
use Imagine\Image\Point;
use Sonata\MediaBundle\Metadata\MetadataBuilderInterface;
use Sonata\MediaBundle\Model\MediaInterface;
class SquareResizer implements ResizerInterface
{
protected $adapter;
protected $mode;
public function __construct(ImagineInterface $adapter, $mode, MetadataBuilderInterface $metadata)
{
$this->adapter = $adapter;
$this->mode = $mode;
$this->metadata = $metadata;
}
public function resize(MediaInterface $media, File $in, File $out, $format, array $settings)
{
if (!isset($settings['width'])) {
throw new \RuntimeException(sprintf('Width parameter is missing in context "%s" for provider "%s"', $media->getContext(), $media->getProviderName()));
}
$image = $this->adapter->load($in->getContent());
$size = $media->getBox();
if (null != $settings['height']) {
if ($size->getHeight() > $size->getWidth()) {
$higher = $size->getHeight();
$lower = $size->getWidth();
} else {
$higher = $size->getWidth();
$lower = $size->getHeight();
}
$crop = $higher - $lower;
if ($crop > 0) {
$point = $higher == $size->getHeight() ? new Point(0, 0) : new Point($crop / 2, 0);
$image->crop($point, new Box($lower, $lower));
$size = $image->getSize();
}
}
$settings['height'] = (int) ($settings['width'] * $size->getHeight() / $size->getWidth());
if ($settings['height'] < $size->getHeight() && $settings['width'] < $size->getWidth()) {
$content = $image
->thumbnail(new Box($settings['width'], $settings['height']), $this->mode)
->get($format, array('quality'=> $settings['quality']));
} else {
$content = $image->get($format, array('quality'=> $settings['quality']));
}
$out->setContent($content, $this->metadata->get($media, $out->getName()));
}
public function getBox(MediaInterface $media, array $settings)
{
$size = $media->getBox();
if (null != $settings['height']) {
if ($size->getHeight() > $size->getWidth()) {
$higher = $size->getHeight();
$lower = $size->getWidth();
} else {
$higher = $size->getWidth();
$lower = $size->getHeight();
}
if ($higher - $lower > 0) {
return new Box($lower, $lower);
}
}
$settings['height'] = (int) ($settings['width'] * $size->getHeight() / $size->getWidth());
if ($settings['height'] < $size->getHeight() && $settings['width'] < $size->getWidth()) {
return new Box($settings['width'], $settings['height']);
}
return $size;
}
}
}
namespace Sonata\MediaBundle\Security
{
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\HttpFoundation\Request;
interface DownloadStrategyInterface
{
public function isGranted(MediaInterface $media, Request $request);
public function getDescription();
}
}
namespace Sonata\MediaBundle\Security
{
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\TranslatorInterface;
class ForbiddenDownloadStrategy implements DownloadStrategyInterface
{
protected $translator;
public function __construct(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function isGranted(MediaInterface $media, Request $request)
{
return false;
}
public function getDescription()
{
return $this->translator->trans('description.forbidden_download_strategy', array(),'SonataMediaBundle');
}
}
}
namespace Sonata\MediaBundle\Security
{
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\TranslatorInterface;
class PublicDownloadStrategy implements DownloadStrategyInterface
{
protected $translator;
public function __construct(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function isGranted(MediaInterface $media, Request $request)
{
return true;
}
public function getDescription()
{
return $this->translator->trans('description.public_download_strategy', array(),'SonataMediaBundle');
}
}
}
namespace Sonata\MediaBundle\Security
{
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Translation\TranslatorInterface;
class RolesDownloadStrategy implements DownloadStrategyInterface
{
protected $roles;
protected $security;
protected $translator;
public function __construct(TranslatorInterface $translator, SecurityContextInterface $security, array $roles = array())
{
$this->roles = $roles;
$this->security = $security;
$this->translator = $translator;
}
public function isGranted(MediaInterface $media, Request $request)
{
return $this->security->getToken() && $this->security->isGranted($this->roles);
}
public function getDescription()
{
return $this->translator->trans('description.roles_download_strategy', array('%roles%'=>'<code>'.implode('</code>, <code>', $this->roles).'</code>'),'SonataMediaBundle');
}
}
}
namespace Sonata\MediaBundle\Security
{
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\TranslatorInterface;
class SessionDownloadStrategy implements DownloadStrategyInterface
{
protected $container;
protected $translator;
protected $times;
protected $sessionKey ='sonata/media/session/times';
public function __construct(TranslatorInterface $translator, ContainerInterface $container, $times)
{
$this->times = $times;
$this->container = $container;
$this->translator = $translator;
}
public function isGranted(MediaInterface $media, Request $request)
{
if (!$this->container->has('session')) {
return false;
}
$times = $this->getSession()->get($this->sessionKey, 0);
if ($times >= $this->times) {
return false;
}
++$times;
$this->getSession()->set($this->sessionKey, $times);
return true;
}
public function getDescription()
{
return $this->translator->trans('description.session_download_strategy', array('%times%'=> $this->times),'SonataMediaBundle');
}
private function getSession()
{
return $this->container->get('session');
}
}
}
namespace Symfony\Component\Templating\Helper
{
interface HelperInterface
{
public function getName();
public function setCharset($charset);
public function getCharset();
}
}
namespace Symfony\Component\Templating\Helper
{
abstract class Helper implements HelperInterface
{
protected $charset ='UTF-8';
public function setCharset($charset)
{
$this->charset = $charset;
}
public function getCharset()
{
return $this->charset;
}
}
}
namespace Sonata\MediaBundle\Templating\Helper
{
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Provider\Pool;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Templating\Helper\Helper;
class MediaHelper extends Helper
{
protected $pool = null;
protected $templating = null;
public function __construct(Pool $pool, EngineInterface $templating)
{
$this->pool = $pool;
$this->templating = $templating;
}
public function getName()
{
return'sonata_media';
}
public function media($media, $format, $options = array())
{
if (!$media) {
return'';
}
$provider = $this->getProvider($media);
$format = $provider->getFormatName($media, $format);
$options = $provider->getHelperProperties($media, $format, $options);
return $this->templating->render($provider->getTemplate('helper_view'), array('media'=> $media,'format'=> $format,'options'=> $options,
));
}
private function getProvider(MediaInterface $media)
{
return $this->pool->getProvider($media->getProviderName());
}
public function thumbnail($media, $format, $options = array())
{
if (!$media) {
return'';
}
$provider = $this->getProvider($media);
$format = $provider->getFormatName($media, $format);
$formatDefinition = $provider->getFormat($format);
$options = array_merge(array('title'=> $media->getName(),'width'=> $formatDefinition['width'],
), $options);
$options['src'] = $provider->generatePublicUrl($media, $format);
return $this->getTemplating()->render($provider->getTemplate('helper_thumbnail'), array('media'=> $media,'options'=> $options,
));
}
public function path($media, $format)
{
if (!$media) {
return'';
}
$provider = $this->getProvider($media);
$format = $provider->getFormatName($media, $format);
return $provider->generatePublicUrl($media, $format);
}
}
}
namespace Sonata\MediaBundle\Thumbnail
{
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Provider\MediaProviderInterface;
interface ThumbnailInterface
{
public function generatePublicUrl(MediaProviderInterface $provider, MediaInterface $media, $format);
public function generatePrivateUrl(MediaProviderInterface $provider, MediaInterface $media, $format);
public function generate(MediaProviderInterface $provider, MediaInterface $media);
public function delete(MediaProviderInterface $provider, MediaInterface $media);
}
}
namespace Sonata\MediaBundle\Thumbnail
{
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Provider\MediaProviderInterface;
use Sonata\NotificationBundle\Backend\BackendInterface;
class ConsumerThumbnail implements ThumbnailInterface
{
protected $id;
protected $thumbnail;
protected $backend;
public function __construct($id, ThumbnailInterface $thumbnail, BackendInterface $backend)
{
$this->id = $id;
$this->thumbnail = $thumbnail;
$this->backend = $backend;
}
public function generatePublicUrl(MediaProviderInterface $provider, MediaInterface $media, $format)
{
return $this->thumbnail->generatePrivateUrl($provider, $media, $format);
}
public function generatePrivateUrl(MediaProviderInterface $provider, MediaInterface $media, $format)
{
return $this->thumbnail->generatePrivateUrl($provider, $media, $format);
}
public function generate(MediaProviderInterface $provider, MediaInterface $media)
{
$this->backend->createAndPublish('sonata.media.create_thumbnail', array('thumbnailId'=> $this->id,'mediaId'=> $media->getId(),'providerReference'=> $media->getProviderReference(),
));
}
public function delete(MediaProviderInterface $provider, MediaInterface $media)
{
return $this->thumbnail->delete($provider, $media);
}
}
}
namespace Sonata\MediaBundle\Thumbnail
{
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Provider\MediaProviderInterface;
class FormatThumbnail implements ThumbnailInterface
{
private $defaultFormat;
public function __construct($defaultFormat)
{
$this->defaultFormat = $defaultFormat;
}
public function generatePublicUrl(MediaProviderInterface $provider, MediaInterface $media, $format)
{
if ($format =='reference') {
$path = $provider->getReferenceImage($media);
} else {
$path = sprintf('%s/thumb_%s_%s.%s', $provider->generatePath($media), $media->getId(), $format, $this->getExtension($media));
}
return $path;
}
public function generatePrivateUrl(MediaProviderInterface $provider, MediaInterface $media, $format)
{
if ('reference'=== $format) {
return $provider->getReferenceImage($media);
}
return sprintf('%s/thumb_%s_%s.%s',
$provider->generatePath($media),
$media->getId(),
$format,
$this->getExtension($media)
);
}
public function generate(MediaProviderInterface $provider, MediaInterface $media)
{
if (!$provider->requireThumbnails()) {
return;
}
$referenceFile = $provider->getReferenceFile($media);
if (!$referenceFile->exists()) {
return;
}
foreach ($provider->getFormats() as $format => $settings) {
if (substr($format, 0, strlen($media->getContext())) == $media->getContext() || $format ==='admin') {
$provider->getResizer()->resize(
$media,
$referenceFile,
$provider->getFilesystem()->get($provider->generatePrivateUrl($media, $format), true),
$this->getExtension($media),
$settings
);
}
}
}
public function delete(MediaProviderInterface $provider, MediaInterface $media)
{
foreach ($provider->getFormats() as $format => $definition) {
$path = $provider->generatePrivateUrl($media, $format);
if ($path && $provider->getFilesystem()->has($path)) {
$provider->getFilesystem()->delete($path);
}
}
}
protected function getExtension(MediaInterface $media)
{
$ext = $media->getExtension();
if (!is_string($ext) || strlen($ext) < 3) {
$ext = $this->defaultFormat;
}
return $ext;
}
}
}
namespace Sonata\MediaBundle\Twig\Extension
{
use Sonata\CoreBundle\Model\ManagerInterface;
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Provider\Pool;
use Sonata\MediaBundle\Twig\TokenParser\MediaTokenParser;
use Sonata\MediaBundle\Twig\TokenParser\PathTokenParser;
use Sonata\MediaBundle\Twig\TokenParser\ThumbnailTokenParser;
class MediaExtension extends \Twig_Extension
{
protected $mediaService;
protected $resources = array();
protected $mediaManager;
protected $environment;
public function __construct(Pool $mediaService, ManagerInterface $mediaManager)
{
$this->mediaService = $mediaService;
$this->mediaManager = $mediaManager;
}
public function getTokenParsers()
{
return array(
new MediaTokenParser($this->getName()),
new ThumbnailTokenParser($this->getName()),
new PathTokenParser($this->getName()),
);
}
public function initRuntime(\Twig_Environment $environment)
{
$this->environment = $environment;
}
public function getName()
{
return'sonata_media';
}
public function media($media = null, $format, $options = array())
{
$media = $this->getMedia($media);
if (!$media) {
return'';
}
$provider = $this
->getMediaService()
->getProvider($media->getProviderName());
$format = $provider->getFormatName($media, $format);
$options = $provider->getHelperProperties($media, $format, $options);
return $this->render($provider->getTemplate('helper_view'), array('media'=> $media,'format'=> $format,'options'=> $options,
));
}
private function getMedia($media)
{
if (!$media instanceof MediaInterface && strlen($media) > 0) {
$media = $this->mediaManager->findOneBy(array('id'=> $media,
));
}
if (!$media instanceof MediaInterface) {
return false;
}
if ($media->getProviderStatus() !== MediaInterface::STATUS_OK) {
return false;
}
return $media;
}
public function thumbnail($media = null, $format, $options = array())
{
$media = $this->getMedia($media);
if (!$media) {
return'';
}
$provider = $this->getMediaService()
->getProvider($media->getProviderName());
$format = $provider->getFormatName($media, $format);
$format_definition = $provider->getFormat($format);
$defaultOptions = array('title'=> $media->getName(),
);
if ($format_definition['width']) {
$defaultOptions['width'] = $format_definition['width'];
}
if ($format_definition['height']) {
$defaultOptions['height'] = $format_definition['height'];
}
$options = array_merge($defaultOptions, $options);
$options['src'] = $provider->generatePublicUrl($media, $format);
return $this->render($provider->getTemplate('helper_thumbnail'), array('media'=> $media,'options'=> $options,
));
}
public function render($template, array $parameters = array())
{
if (!isset($this->resources[$template])) {
$this->resources[$template] = $this->environment->loadTemplate($template);
}
return $this->resources[$template]->render($parameters);
}
public function path($media = null, $format)
{
$media = $this->getMedia($media);
if (!$media) {
return'';
}
$provider = $this->getMediaService()
->getProvider($media->getProviderName());
$format = $provider->getFormatName($media, $format);
return $provider->generatePublicUrl($media, $format);
}
public function getMediaService()
{
return $this->mediaService;
}
}
}
namespace
{
interface Twig_NodeInterface extends Countable, IteratorAggregate
{
public function compile(Twig_Compiler $compiler);
public function getLine();
public function getNodeTag();
}
}
namespace
{
class Twig_Node implements Twig_NodeInterface
{
protected $nodes;
protected $attributes;
protected $lineno;
protected $tag;
public function __construct(array $nodes = array(), array $attributes = array(), $lineno = 0, $tag = null)
{
$this->nodes = $nodes;
$this->attributes = $attributes;
$this->lineno = $lineno;
$this->tag = $tag;
}
public function __toString()
{
$attributes = array();
foreach ($this->attributes as $name => $value) {
$attributes[] = sprintf('%s: %s', $name, str_replace("\n",'', var_export($value, true)));
}
$repr = array(get_class($this).'('.implode(', ', $attributes));
if (count($this->nodes)) {
foreach ($this->nodes as $name => $node) {
$len = strlen($name) + 4;
$noderepr = array();
foreach (explode("\n", (string) $node) as $line) {
$noderepr[] = str_repeat(' ', $len).$line;
}
$repr[] = sprintf('  %s: %s', $name, ltrim(implode("\n", $noderepr)));
}
$repr[] =')';
} else {
$repr[0] .=')';
}
return implode("\n", $repr);
}
public function toXml($asDom = false)
{
@trigger_error(sprintf('%s is deprecated since version 1.16.1 and will be removed in 2.0.', __METHOD__), E_USER_DEPRECATED);
$dom = new DOMDocument('1.0','UTF-8');
$dom->formatOutput = true;
$dom->appendChild($xml = $dom->createElement('twig'));
$xml->appendChild($node = $dom->createElement('node'));
$node->setAttribute('class', get_class($this));
foreach ($this->attributes as $name => $value) {
$node->appendChild($attribute = $dom->createElement('attribute'));
$attribute->setAttribute('name', $name);
$attribute->appendChild($dom->createTextNode($value));
}
foreach ($this->nodes as $name => $n) {
if (null === $n) {
continue;
}
$child = $n->toXml(true)->getElementsByTagName('node')->item(0);
$child = $dom->importNode($child, true);
$child->setAttribute('name', $name);
$node->appendChild($child);
}
return $asDom ? $dom : $dom->saveXML();
}
public function compile(Twig_Compiler $compiler)
{
foreach ($this->nodes as $node) {
$node->compile($compiler);
}
}
public function getLine()
{
return $this->lineno;
}
public function getNodeTag()
{
return $this->tag;
}
public function hasAttribute($name)
{
return array_key_exists($name, $this->attributes);
}
public function getAttribute($name)
{
if (!array_key_exists($name, $this->attributes)) {
throw new LogicException(sprintf('Attribute "%s" does not exist for Node "%s".', $name, get_class($this)));
}
return $this->attributes[$name];
}
public function setAttribute($name, $value)
{
$this->attributes[$name] = $value;
}
public function removeAttribute($name)
{
unset($this->attributes[$name]);
}
public function hasNode($name)
{
return array_key_exists($name, $this->nodes);
}
public function getNode($name)
{
if (!array_key_exists($name, $this->nodes)) {
throw new LogicException(sprintf('Node "%s" does not exist for Node "%s".', $name, get_class($this)));
}
return $this->nodes[$name];
}
public function setNode($name, $node = null)
{
$this->nodes[$name] = $node;
}
public function removeNode($name)
{
unset($this->nodes[$name]);
}
public function count()
{
return count($this->nodes);
}
public function getIterator()
{
return new ArrayIterator($this->nodes);
}
}
}
namespace Sonata\MediaBundle\Twig\Node
{
class MediaNode extends \Twig_Node
{
protected $extensionName;
public function __construct($extensionName, \Twig_Node_Expression $media, \Twig_Node_Expression $format, \Twig_Node_Expression $attributes, $lineno, $tag = null)
{
$this->extensionName = $extensionName;
parent::__construct(array('media'=> $media,'format'=> $format,'attributes'=> $attributes), array(), $lineno, $tag);
}
public function compile(\Twig_Compiler $compiler)
{
$compiler
->addDebugInfo($this)
->write(sprintf("echo \$this->env->getExtension('%s')->media(", $this->extensionName))
->subcompile($this->getNode('media'))
->raw(', ')
->subcompile($this->getNode('format'))
->raw(', ')
->subcompile($this->getNode('attributes'))
->raw(");\n")
;
}
}
}
namespace Sonata\MediaBundle\Twig\Node
{
class PathNode extends \Twig_Node
{
protected $extensionName;
public function __construct($extensionName, \Twig_Node_Expression $media, \Twig_Node_Expression $format, $lineno, $tag = null)
{
$this->extensionName = $extensionName;
parent::__construct(array('media'=> $media,'format'=> $format), array(), $lineno, $tag);
}
public function compile(\Twig_Compiler $compiler)
{
$compiler
->addDebugInfo($this)
->write(sprintf("echo \$this->env->getExtension('%s')->path(", $this->extensionName))
->subcompile($this->getNode('media'))
->raw(', ')
->subcompile($this->getNode('format'))
->raw(");\n")
;
}
}
}
namespace Sonata\MediaBundle\Twig\Node
{
class ThumbnailNode extends \Twig_Node
{
protected $extensionName;
public function __construct($extensionName, \Twig_Node_Expression $media, \Twig_Node_Expression $format, \Twig_Node_Expression $attributes, $lineno, $tag = null)
{
$this->extensionName = $extensionName;
parent::__construct(array('media'=> $media,'format'=> $format,'attributes'=> $attributes), array(), $lineno, $tag);
}
public function compile(\Twig_Compiler $compiler)
{
$compiler
->addDebugInfo($this)
->write(sprintf("echo \$this->env->getExtension('%s')->thumbnail(", $this->extensionName))
->subcompile($this->getNode('media'))
->raw(', ')
->subcompile($this->getNode('format'))
->raw(', ')
->subcompile($this->getNode('attributes'))
->raw(");\n")
;
}
}
}