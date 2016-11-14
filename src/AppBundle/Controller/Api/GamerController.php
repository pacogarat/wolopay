<?php

namespace AppBundle\Controller\Api;


use AppBundle\Entity\Affiliate;
use AppBundle\Entity\AppApiCredentials;
use AppBundle\Entity\Gamer;
use AppBundle\Form\Type\Api\GamerApiType;
use AppBundle\Form\Type\Api\GamerUpdateApiType;
use FOS\RestBundle\Controller\Annotations\Patch;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Util\Codes;
use JMS\DiExtraBundle\Annotation as DI;
use JMS\Serializer\SerializationContext;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class GamerController extends AbstractAPI
{
    /**
     * Create a gamer to increase stats
     *
     * @Post("/gamer")
     * @ApiDoc(
     *   section = "Good features",
     *   statusCodes = {
     *     201 = "Returned when successful"
     *   },
     *  input = "AppBundle\Form\Type\Api\GamerApiType",
     *  output={
     *   "class"   = "AppBundle\Entity\Gamer",
     *   "groups" = {"Public"},
     *   "parsers" = {
     *        "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *    }
     *   }
     * )
     *
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return array
     */
    public function postGamerAction(Request $request)
    {
        $this->throwExceptionIfItsGrantedByJWT();
        /** @var AppApiCredentials $appCredentials */
        $appCredentials = $this->getUser();

        $em = $this->getDoctrine()->getManager();

        $gamer = new Gamer($appCredentials->getApp(), null);
        $form = $this->createForm(new GamerApiType(), $gamer);

        $form->submit($request);

        if ($form->isValid())
        {
            if ($form->get('affiliate_id')->getData()){
                $affiliate = new Affiliate($appCredentials->getApp()->getClient(),$form->get('affiliate_id')->getData());
                $em->persist($affiliate);
            }

            $gamer->setApp($appCredentials->getApp());
            $em->persist($gamer);
            $em->flush();

            $view = $this->view($gamer, 201);
            $view->setSerializationContext(SerializationContext::create()->setGroups(array('Default')));

            return $this->handleView($view);
        }

        return $this->handleView($this->view($form, Codes::HTTP_BAD_REQUEST));
    }


    /**
     * Update partial options from a gamer
     *
     * @ApiDoc(
     *   section = "Good features",
     *   statusCodes = {
     *     201 = "Returned when successful"
     *   },
     *   input = "AppBundle\Form\Type\Api\GamerUpdateApiType",
     *   output={
     *      "class"   = "AppBundle\Entity\Gamer",
     *      "groups" = {"Public"},
     *      "parsers" = {
     *        "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *      }
     *   }
     * )
     *
     * @Patch("/gamer/{gamer_id}", requirements={"gamer_id":".+?"})
     *
     * @param $gamer_id gamer external id
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @throws \Symfony\Component\HttpKernel\Exception\ConflictHttpException
     * @throws \Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException
     * @return array
     */
    public function patchGamerAction($gamer_id, Request $request)
    {
        $this->throwExceptionIfItsGrantedByJWT();
        $affiliate=null;
        /** @var AppApiCredentials $appCredentials */
        $appCredentials = $this->getUser();

        $em = $this->getDoctrine()->getManager();

        /** @var Gamer $gamer */
        if (!$gamer = $em->getRepository("AppBundle:Gamer")->findOneByAppIdAndGamerExternalId($appCredentials->getApp()->getId(), $gamer_id))
            throw new UnprocessableEntityHttpException('gamer id : "'.$gamer_id.'" doesn\'t exist');

        $form = $this->createForm(new GamerUpdateApiType(), $gamer, ['allow_extra_fields' => true]);
        $form->submit($request, false);

        if ($form->isValid())
        {
            $watching = 'affiliate_id';
            if  ($newValue = $form->get($watching)->getData())
            {
                $currentValue = $gamer->getExternalAffiliateId();
                if( ($currentValue) && ($currentValue !== $newValue) ){
                    throw new ConflictHttpException("Conflict Exception: $watching mismatch ($currentValue <> $newValue)");
                }

                $affiliate = $em->getRepository("AppBundle:Affiliate")->findOneByClientIdAndAffiliateId(
                        $appCredentials->getApp()->getClient()->getId(), $form->get("affiliate_id")->getData());

                if (!$affiliate){
                    $affiliate = new Affiliate($appCredentials->getApp()->getClient(), $newValue);
                    $em->persist($affiliate);
                }
                $gamer->setExternalAffiliateId($affiliate->getId());
            }

            $watching = 'steam_id';
            if  ($newValue = $form->get($watching)->getData()){
                $currentValue = $gamer->getSteamId();
                if( ($currentValue) && ($currentValue !== $newValue) ){
                    $this->container->get('logger')->addInfo("Conflict Exception: $watching mismatch ($currentValue <> $newValue");
//                    throw new ConflictHttpException("Conflict Exception: SteamId mismatch ($currentSteamId <> ".$form->get('steam_id')->getData().")");
                }
                $gamer->setSteamId($newValue);

            }

            $watching='email';
            if ($newValue = $form->get($watching)->getData()){
                $currentValue = $gamer->getEmail();
                if (($currentValue) && ($currentValue!== $newValue) ){
                    $this->container->get('logger')->addInfo("Conflict Exception: $watching mismatch ($currentValue <> $newValue)");
                }
                $gamer->setEmail($newValue);
            }

            $watching='name';
            if ($newValue=$form->get($watching)->getData()){
                $currentValue=$gamer->getName();
                if ($currentValue && ($currentValue !== $newValue) ){
                    $this->container->get('logger')->addInfo("Conflict Exception: $watching mismatch ($currentValue <> $newValue");
                }
                $gamer->setName($newValue);
            }

            $watching='surname';
            if ($newValue=$form->get($watching)->getData()){
                $currentValue=$gamer->getSurname();
                if ($currentValue && ($currentValue !== $newValue) ){
                    $this->container->get('logger')->addInfo("Conflict Exception: $watching mismatch ($currentValue <> $newValue");
                }
                $gamer->setSurname($newValue);
            }

            $watching='birthdate';
            if ($newValue=$form->get($watching)->getData()){
                $currentValue=$gamer->getBirthdate();
                if ($currentValue && ($currentValue !== $newValue) ){
                    $this->container->get('logger')->addInfo("Conflict Exception: $watching mismatch ($currentValue <> $newValue");
                }
                $gamer->setBirthdate($newValue);
            }

            $watching='gender';
            if ($newValue=$form->get($watching)->getData()){
                $currentValue=$gamer->getGender();
                if ($currentValue && ($currentValue !== $newValue) ){
                    $this->container->get('logger')->addInfo("Conflict Exception: $watching mismatch ($currentValue <> $newValue");
                }
                $gamer->setGender($newValue);
            }

            $watching='registration_date';
            if ($newValue=$form->get($watching)->getData()){
                $currentValue=$gamer->getRegistrationDateInGame();
                if ($currentValue && ($currentValue !== $newValue) ){
                    $this->container->get('logger')->addInfo("Conflict Exception: $watching mismatch ($currentValue <> $newValue");
                }
                $gamer->setRegistrationDateInGame(new \DateTime($newValue));
            }

            $em->persist($gamer);
            $em->flush();

            $view = $this->view($gamer, Codes::HTTP_OK);
            $view->setSerializationContext(SerializationContext::create()->setGroups(array('Default')));

            return $this->handleView($view);
        }

        return $this->handleView($this->view($form, Codes::HTTP_BAD_REQUEST));
    }

}
