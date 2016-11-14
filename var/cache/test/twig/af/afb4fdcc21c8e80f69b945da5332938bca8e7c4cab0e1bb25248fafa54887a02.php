<?php

/* AppBundle:Others/Default:index.html.twig */
class __TwigTemplate_70cf60509a67c4076912d34b29a5e650123277d24b0134141fadb3e3444b480b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_608dbef8870f6b399f4e9fad07908dffe4f6dbc35ffe7732a292a16571cb75c6 = $this->env->getExtension("native_profiler");
        $__internal_608dbef8870f6b399f4e9fad07908dffe4f6dbc35ffe7732a292a16571cb75c6->enter($__internal_608dbef8870f6b399f4e9fad07908dffe4f6dbc35ffe7732a292a16571cb75c6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Others/Default:index.html.twig"));

        // line 2
        echo "<!DOCTYPE html>
<html>
<head>
    <meta charset=\"utf-8\">
    <title>";
        // line 6
        echo $this->env->getExtension('translator')->trans("meta_title", array(), "default");
        echo "</title>
    <meta name=\"description\" content=\"";
        // line 7
        echo $this->env->getExtension('translator')->trans("meta_description", array(), "default");
        echo "\" />
    <meta name=\"keywords\" content=\"";
        // line 8
        echo $this->env->getExtension('translator')->trans("meta_keywords", array(), "default");
        echo "\" />
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <meta property='og:title' content='Online Payments | Wolopay'/>
    <meta property='og:description' content='";
        // line 11
        echo $this->env->getExtension('translator')->trans("meta_description", array(), "default");
        echo "'/>
    <meta property='og:url' content='https://wolopay.com'/>
    <link rel=\"stylesheet\" href=\"//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css\">

    ";
        // line 15
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "4a8b964_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_4a8b964_0") : $this->env->getExtension('asset')->getAssetUrl("css/4a8b964_animate.min_1.css");
            // line 22
            echo "        <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" media=\"screen\" />
    ";
            // asset "4a8b964_1"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_4a8b964_1") : $this->env->getExtension('asset')->getAssetUrl("css/4a8b964_ionicons_2.css");
            echo "        <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" media=\"screen\" />
    ";
            // asset "4a8b964_2"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_4a8b964_2") : $this->env->getExtension('asset')->getAssetUrl("css/4a8b964_styles_3.css");
            echo "        <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" media=\"screen\" />
    ";
            // asset "4a8b964_3"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_4a8b964_3") : $this->env->getExtension('asset')->getAssetUrl("css/4a8b964_styles_media_4.css");
            echo "        <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" media=\"screen\" />
    ";
            // asset "4a8b964_4"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_4a8b964_4") : $this->env->getExtension('asset')->getAssetUrl("css/4a8b964_bootstrap_extra_5.css");
            echo "        <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" media=\"screen\" />
    ";
        } else {
            // asset "4a8b964"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_4a8b964") : $this->env->getExtension('asset')->getAssetUrl("css/4a8b964.css");
            echo "        <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" media=\"screen\" />
    ";
        }
        unset($context["asset_url"]);
        // line 24
        echo "
</head>
<body>
";
        // line 27
        $this->loadTemplate("@App/Others/Default/partials/home_header.html.twig", "AppBundle:Others/Default:index.html.twig", 27)->display($context);
        // line 28
        echo "<header id=\"intro\">
    <div class=\"header-content\">
        <div class=\"inner\">
            <div id=\"main-text\">
                <h1 class=\"wow fadeIn \" data-wow-delay=\".1s\">The BEST Storefront Management </h1>
                <h3 class=\"wow fadeIn \" data-wow-delay=\".8s\">and</h3>
                <h1 class=\"wow fadeInRight \" data-wow-delay=\".8s\">Worldwide Payment Solutions Hub,</h1>
                <h3 class=\"wow fadeIn \" data-wow-delay=\".9s\">all</h3>
                <h1 class=\"wow fadeInLeft\" data-wow-delay=\".9s\">In one simple REST API</h1>
                <hr>
                <hr>
                <hr>
                <h2 class=\"wow fadeInRight\" data-wow-delay=\"1s\">Manage your what you sell in Web, Facebook, Steam...</h2>
                <h2 class=\"wow fadeInLeft\" data-wow-delay=\"1.1s\">Start accepting payments worldwide seamlessly in your web, </h2>
                <h2 class=\"wow fadeInRight\" data-wow-delay=\"1.2s\">and increase your revenues instantly!</h2>
            </div>
            <div id=\"video\" style=\"display: none\">
                <iframe data-srcx=\"https://www.youtube.com/embed/QSKRY2ZYcOE?autoplay=1\" frameborder=\"0\" allowfullscreen></iframe>
            </div>
            <div id=\"header-buttons\">
                <button id=\"toggleVideo\" data-toggle=\"collapse\" class=\"btn btn-primary btn-xl\">Watch Video</button> &nbsp;
                <a href=\"#tryit\" class=\"btn btn-primary btn-xl page-scroll\">Try Wolopay</a>
            </div>
        </div>
    </div>

</header>

<section class=\"bg-primary\" id=\"one\">
    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-lg-12 col-md-8 text-justify \">
                <h2 class=\"margin-top-0 text-primary h2-light wow fadeInUp\">WORLDWIDE PAYMENT FOR YOUR PRODUCT</h2>
                <br>
                <p class=\"text-faded wow fadeIn\">
                    Wolopay is the best and ultimate payment solution and storefront management for games. It’s an unparalleled unique Storefront management tool (or SaaS, Store as a Service) to include in your monetization strategy, in order to increase visits to your games’ shops and improve their conversion rates, (that is, to increase in-game or in-app purchases), joined with a global payment solution hub with worldwide coverage, thanks to its more than 300 payment methods integrated via different PSPs. It’s your games’ window to the world, perfectly integrated with their look and feel… where your users will be willing to pay, in their preferred payment method, in their local currency...
                </p>
                <p class=\"text-faded wow fadeIn\">
                    Forget about having different payment solutions, aggregators, and integrations for different countries, selling packs of virtual currency, having to decide prices for them based on intuition… Forget about having to develop a shop in your side and manage what items you sell for the game, and in exchange of how much virtual currency! You can do it all in a single contract, integration, interface, and money flow, and with the help of experts:
                </p>
                <p class=\"text-faded wow fadeIn\">
                    Wolopay is formed by a team of professionals that come from the gaming industry, and are specialized in monetization and payments; they will help you integrate the solution, and configure it to increase the visits to the shop, improve its effectiveness and profitability, and in the end, boost your conversion rates and incomes.
                </p>
                <p class=\"text-faded wow fadeIn\">
                    Wolopay makes developers' lives easier when it comes to manage their shop, in-app articles, prices, offers, and accept payments in all the platforms for all of his games, worldwide. One integration will allow the games to have items, articles, packs, GACHAs, tabs, all localizations, prices, offers, coupons, a virtual currency, and of course stats, and many more things, all together. Additionally, Wolopay is a “payment hub”; a new concept of a payment solution: integrate with Wolopay and you will have solved at once your integration with STEAM, Facebook, the Chrome Webstore, and many more international stores!  One invoice, one transfer, and the developer will get all the money from all the platforms at once.  And everything within a web application with simple step-by-step wizards and easy to use menus.
                </p>
                <p class=\"text-faded wow fadeIn\">
                    Let Wolopay be your storefront manager, your shopkeeper, offer programmer, coupon manager and your payment solution.  Let Wolopay be your window to the world and start increasing your sales and revenues.
                </p>

            </div>
        </div>
    </div>
</section>

<section id=\"tryit\">
    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-lg-12 text-center\">
                <h2 class=\"margin-top-0 text-primary\">Try it now!</h2>
                <hr class=\"primary\">
                <br>
                <p class=\"wow fadeIn\">
                    Click here to see a real example of our impressive fully-flexible storefront and payment solution...
                </p>
                <div class=\"col-xs-12 center-block text-center btn-content wow fadeInDown\" data-wow-delay=\".3s\" style=\"margin-bottom: 20px\">
                    <div class=\"\" role=\"group\">
                        <span class=\"btn btn-info btn-xl page-scroll shop-iframe\">
                            Shop iframe <i class=\"icon ion-ios-arrow-forward\"></i>
                        </span>
                        <span onclick=\"woPlugin.open('";
        // line 98
        echo $this->env->getExtension('routing')->getPath("example_light_box");
        echo "')\" class=\"btn btn-warning btn-xl page-scroll shop-lightbox\">
                            Shop lightbox <i class=\"icon ion-ios-arrow-forward \"></i>
                        </span>
                        <span class=\"btn btn-special btn-xl widget payment-widget\">
                            See a payment widget <i class=\"icon ion-ios-arrow-forward\"></i>
                        </span>

                        <a target=\"_blank\" href=\"https://sandbox.wolopay.com";
        // line 105
        echo $this->env->getExtension('routing')->getPath("try_control_panel");
        echo "\" class=\"btn btn-default btn-xl\">
                            Control panel
                        </a>

                    </div>
                </div>

                <div id=\"iframe-shop-container\" style=\"display: none\">

                    <div class=\"devices\" role=\"group\">

                        <span class=\"btn laptop active\">
                            <i class=\"icon ion-monitor\"></i>
                        </span>

                        <span class=\"btn tablet\">
                            <i class=\"icon ion-ipad\"></i>
                        </span>

                        <span class=\"btn mobile \">
                            <i class=\"icon ion-iphone\"></i>
                        </span>

                    </div>

                    <iframe id=\"iframe-shop\" scrolling=\"no\" data-srcx=\"";
        // line 130
        echo $this->env->getExtension('routing')->getPath("example");
        echo "\" style=\"width: 1020px; height: 1000px; overflow-y:hidden;\"></iframe>

                </div>

                <iframe id=\"iframe-payment-widget\" style=\"display: none\" data-srcx=\"";
        // line 134
        echo $this->env->getExtension('routing')->getPath("example_payment_widget");
        echo "\"></iframe>

            </div>
        </div>
    </div>
    <div class=\"container\">
        <div class=\"row\">
            <!--<div class=\"col-lg-4 col-md-4 text-center\">
                <div class=\"feature\">
                    <i class=\"icon-lg ion-android-laptop wow fadeIn\" data-wow-delay=\".3s\"></i>
                    <h3>Game</h3>
                    <p class=\"text-muted\">Your site looks good everywhere</p>
                </div>
            </div>
            <div class=\"col-lg-4 col-md-4 text-center\">
                <div class=\"feature\">
                    <i class=\"icon-lg ion-social-sass wow fadeInUp\" data-wow-delay=\".2s\"></i>
                    <h3>Shop</h3>
                    <p class=\"text-muted\">Easy to theme and customize with SASS</p>
                </div>
            </div>
            <div class=\"col-lg-4 col-md-4 text-center\">
                <div class=\"feature\">
                    <i class=\"icon-lg ion-ios-star-outline wow fadeIn\" data-wow-delay=\".3s\"></i>
                    <h3>Selected tab \"Card Set\"</h3>
                    <p class=\"text-muted\">A mature, well-tested, stable codebase</p>
                </div>
            </div>-->

        </div>
    </div>
</section>

<section class=\"container-fluid\" id=\"features\">
    <div class=\"row\">
        <div class=\"col-xs-12 col-sm-12 col-md-10 col-md-offset-1\">
            <h2 class=\"text-center h2-light text-primary\">Features</h2>
            <hr>
            <div class=\"col-lg-6 col-md-6 text-center\">
                <div class=\"media wow fadeInRight\">
                    <div class=\"media-middle\">
                        <i class=\"icon-lg ion-cash\"></i>
                    </div>
                    <h3 class=\"text-secondary\">Go Local:</h3>

                    <div class=\"media-body text-justify text-faded\">
                        <p>+150 currencies: users see prices in their local currency, wherever.</p>
                        <p>+170 languages: show description of what you’re selling in users’ language.</p>
                        <p>Local payment methods to every country in the world (but including global credit cards, and recurring payments, of course!), ordered by popularity.</p>
                        <p>Wolopay patent pending  “Standard Of Living Automatic Adaptor”, to suggest (but not impose) local prices affordable to people in the country (instead of having prices as if everyone was from the United States, Germany or South Korea).</p>
                        <p>Don’t want to set-up different prices per country? Group the least important for you, per continent, and set-up a common price for them...</p>
                    </div>
                </div>
            </div>

            <div class=\"col-lg-6 col-md-6 text-center\">
                <div class=\"media wow fadeInLeft\">
                    <div class=\"media-middle\">
                        <i class=\"icon-lg ion-ios-gear-outline\"></i>
                    </div>
                    <h3 class=\"text-secondary\">Manage what you sell:</h3>
                    <div class=\"media-body media-middle text-justify text-faded\">
                        <p>Wolopay advices customers with its monetization improvement knowledge, recommending best-practices, in an unmatched consultancy service, included in our monthly fee.</p>
                        <p>Create your items (can be virtual currency for one game or cross-game, or can be “resources” as wood, iron, silver, gold...) </p>
                        <p>Create articles with many different options like validity between dates, global or per-user limits, customized image and extended descriptions.</p>
                        <p>Create packs as sets of existing articles, or “random packs”.</p>
                        <p>Create different kinds of Gachas to increase conversion rates drastically.</p>
                        <p>Do you have multiple apps, plus one Virtual Currency that can be exchanged for items in your apps? We handle that too.</p>
                    </div>
                </div>
            </div>
            <div class=\"col-lg-6 col-md-6 text-center\">
                <div class=\"media wow fadeInRight\">
                    <div class=\"media-middle\">
                        <i class=\"icon-lg ion-ios-pricetags-outline\"></i>
                    </div>
                    <h3 class=\"text-secondary\">Flexibly manage offers of your products:</h3>
                    <div class=\"media-body text-justify text-faded\">
                        <p>Offer discount in prices, or increase the items given, or give extra articles…  or make your own mix.</p>
                        <p>Make offers valid for one or more countries...</p>
                        <p>Make the same offer in different articles at once (everything 20% off), or per article.</p>
                        <p>Create Seasonal Promotions and Gift codes.</p>
                        <p>Cross-platform, of course!</p>
                    </div>
                </div>
            </div>
            <div class=\"col-lg-6 col-md-6 text-center\">
                <div class=\"media wow fadeInLeft\">
                    <div class=\"media-middle\">
                        <i class=\"icon-lg ion-ios-cog\"></i>
                    </div>
                    <h3 class=\"text-secondary\">We blend with your game:</h3>
                    <!--<div class=\"media-left\">
                        <a href=\"#alertModal\" data-toggle=\"modal\" data-target=\"#alertModal\"><i class=\"icon-lg ion-ios-cloud-download-outline\"></i></a>
                    </div>-->
                    <div class=\"media-body media-middle text-justify text-faded\">
                        <p>Flexible, fully configurable Skins for your shops: Integrate seamlessly in mobile, tablet or web automatically: no extra integration or configuration.</p>
                        <p>Categorize your articles and group them into “tabs” to make them easy to find .</p>
                        <p>Configure different “shops” depending on users’ level… Newbies won’t see the same tabs, articles, prices, or even offers, as expert users.</p>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>

<section id=\"pricing\" >
<div class=\"container\">
<div class=\"row\">
<div class=\"col-lg-12 text-center\">
<h2 class=\"margin-top-0 text-primary\">Pricing</h2>
<br>
<div class=\"col-lg-12\">
<div class=\"panel panel-default panel-wolopay-offer\">
    <div class=\"panel-heading\">
        <h3>Wolopay Offer</h3>
    </div>
    <!-- /.panel-heading -->
    <div class=\"panel-body\">
        <div class=\"table-responsive wow fadeInLeft\">
            <table class=\"table table-striped-custom table-bordered table-hover-custom\">
                <thead>
                <tr>
                    <th></th>
                    <th class=\"mini-tab text-center border-mini\">Mini</th>
                    <th class=\"developer-tab text-center\">Developer</th>
                    <th class=\"publisher-tab text-center\">Publisher</th>
                    <th class=\"premium-tab text-center\">Premium Platinum Partner</th>
                </tr>
                </thead>
                <tbody>
                <tr class=\"offer-tab\">
                    <td class=\"text-left\">Pay Methods</td>
                    <td class=\"border-mini\">All</td>
                    <td>All</td>
                    <td>All</td>
                    <td>All</td>
                </tr>
                <tr class=\"offer-tab\">
                    <td class=\"text-left\">Dedicated Gateways</td>
                    <td class=\"border-mini\">-</td>
                    <td>-</td>
                    <td>Yes, for Wolopay existing ones(*)</td>
                    <td>Yes, plus up to 3 integrations on demand</td>
                </tr>
                <tr class=\"offer-tab\">
                    <td class=\"text-left\">Risk & Fraud Control</td>
                    <td class=\"border-mini\">Included</td>
                    <td>Included</td>
                    <td>Included</td>
                    <td>Included</td>
                </tr>
                <tr class=\"offer-tab\">
                    <td class=\"text-left\">Items</td>
                    <td class=\"border-mini\">Unlimited</td>
                    <td>Unlimited</td>
                    <td>Unlimited</td>
                    <td>Unlimited</td>
                </tr>
                <tr class=\"offer-tab\">
                    <td class=\"text-left\">Articles</td>
                    <td class=\"border-mini\">Unlimited</td>
                    <td>Unlimited</td>
                    <td>Unlimited</td>
                    <td>Unlimited</td>
                </tr>
                <tr class=\"offer-tab\">
                    <td class=\"text-left\">Offers</td>
                    <td class=\"border-mini\">Unlimited</td>
                    <td>Unlimited</td>
                    <td>Unlimited</td>
                    <td>Unlimited</td>
                </tr>
                <tr class=\"offer-tab\">
                    <td class=\"text-left\">Coupons</td>
                    <td class=\"border-mini\">-</td>
                    <td>Unlimited</td>
                    <td>Unlimited</td>
                    <td>Unlimited + API Available</td>
                </tr>
                <tr class=\"offer-tab\">
                    <td class=\"text-left\">Tutorial for end-users</td>
                    <td class=\"border-mini\">-</td>
                    <td>Yes</td>
                    <td>Yes, plus promotional code</td>
                    <td>Yes, plus promotional code</td>
                </tr>
                <tr class=\"offer-tab\">
                    <td class=\"text-left\">Blacklisting</td>
                    <td class=\"border-mini\">-</td>
                    <td>Country, IP, User Id</td>
                    <td>Country, IP, User Id</td>
                    <td>Country, IP, User Id</td>
                </tr>
                <tr class=\"offer-tab\">
                    <td class=\"text-left\">Number of Countries & Currencies</td>
                    <td class=\"border-mini\">10</td>
                    <td>Unlimited</td>
                    <td>Unlimited</td>
                    <td>Unlimited</td>
                </tr>
                <tr class=\"offer-tab\">
                    <td class=\"text-left\">Country Grouping per Area</td>
                    <td class=\"border-mini\">No</td>
                    <td>1 Area</td>
                    <td>Unlimited</td>
                    <td>Unlimited</td>
                </tr>
                <tr class=\"offer-tab\">
                    <td class=\"text-left\">Number of Languages</td>
                    <td class=\"border-mini\">10</td>
                    <td>Unlimited</td>
                    <td>Unlimited</td>
                    <td>Unlimited</td>
                </tr>
                <tr class=\"offer-tab\">
                    <td class=\"text-left\">Apps</td>
                    <td class=\"border-mini\">1</td>
                    <td>3</td>
                    <td>10</td>
                    <td>Unlimited</td>
                </tr>
                <tr class=\"offer-tab\">
                    <td class=\"text-left\">Shops</td>
                    <td class=\"border-mini\">1</td>
                    <td>1 per App</td>
                    <td>5 per App</td>
                    <td>5 per App</td>
                </tr>
                <tr class=\"offer-tab\">
                    <td class=\"text-left\">Customized Skins</td>
                    <td class=\"border-mini\">1</td>
                    <td>Up to 3 per App</td>
                    <td>Up to 3 per App and Shop</td>
                    <td>Unlimited</td>
                </tr>
                <tr class=\"offer-tab\">
                    <td class=\"text-left\">Tabs</td>
                    <td class=\"border-mini\">1</td>
                    <td>3 per App</td>
                    <td>Unlimited</td>
                    <td>Unlimited</td>
                </tr>
                <tr class=\"offer-tab\">
                    <td class=\"text-left\">Virtual Currency & e-Wallet</td>
                    <td class=\"border-mini\">-</td>
                    <td>Per App</td>
                    <td>Per App</td>
                    <td>Valid within All Apps</td>
                </tr>
                <tr class=\"offer-tab\">
                    <td class=\"text-left\">Affiliate Sales Stats</td>
                    <td class=\"border-mini\">-</td>
                    <td>Yes</td>
                    <td>Yes</td>
                    <td>Yes</td>
                </tr>
                <tr class=\"offer-tab\">
                    <td class=\"text-left\">Extended User Info for Stats</td>
                    <td class=\"border-mini\">-</td>
                    <td>-</td>
                    <td>Yes, via API</td>
                    <td>Yes, via API</td>
                </tr>
                <tr class=\"offer-tab\">
                    <td class=\"text-left\">Cost per succesful transaction</td>
                    <td class=\"border-mini\">0,15 €</td>
                    <td>0,12 €</td>
                    <td>0,10 €</td>
                    <td>0,05 €</td>
                </tr>
                <tr class=\"offer-tab\">
                    <td class=\"text-left\">Minimum transactions</td>
                    <td class=\"border-mini\">500</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                </tr>
                <tr class=\"offer-tab\">
                    <td class=\"price-tab\">PRICE</td>
                    <td class=\"mini-tab-bot\">3 MONTHS TRIAL FOR FREE (**)</td>
                    <td class=\"developer-tab-bot\">100€/MONTH</td>
                    <td class=\"publisher-tab-bot\">150€/MONTH BEST OPTION</td>
                    <td class=\"premium-tab-bot\">750 €/MONTH</td>
                </tr>
                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.panel-body -->
    <span class=\"text-right\">(*) Existing Gateways (Steam, Facebook, Paypal, Adyen, Neteller, PaySafeCard, G2APay)</span><br>
    <span class=\"text-right\">(**) Minimum transactions waived during first 3 months</span>
</div>
<!-- /.panel -->



<div class=\"row content-panel-offer\">
    <div class=\"col-lg-4 col-sm-4 col-xs-12 \">
        <div class=\"panel panel-offer\">
            <div class=\"panel-heading\">
                <div class=\"row\">
                    <div class=\"col-xs-3 wow fadeInUp\">
                        <img class=\"img-panel-offer\" src=\"/bundles/app/default/images/icon-chargebacks.png\">
                    </div>
                    <div class=\"col-xs-9 text-right wow fadeIn\" data-wow-delay=\".3s\">
                        <div class=\"number-panel\">15 €</div>
                        <div class=\"text-panel\">Chargebacks</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class=\"col-lg-4 col-sm-4 col-xs-12\">
        <div class=\"panel panel-offer\">
            <div class=\"panel-heading\">
                <div class=\"row\">
                    <div class=\"col-xs-3 wow fadeInUp\">
                        <img class=\"img-panel-offer\" src=\"/bundles/app/default/images/icon-exchange.png\">
                    </div>
                    <div class=\"col-xs-9 text-right wow fadeIn\" data-wow-delay=\".3s\">
                        <div class=\"number-panel\">2.50%</div>
                        <div class=\"text-panel\">Currency Exchange</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class=\"col-lg-4 col-sm-4 col-xs-12\">
        <div class=\"panel panel-offer\">
            <div class=\"panel-heading\">
                <div class=\"row\">
                    <div class=\"col-xs-3 wow fadeInUp\">
                        <img class=\"img-panel-offer\" src=\"/bundles/app/default/images/icon-refunds.png\">
                    </div>
                    <div class=\"col-xs-9 text-right wow fadeIn\" data-wow-delay=\".3s\">
                        <div class=\"number-panel\">0.10€</div>
                        <div class=\"text-panel\">Refunds</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.panel offer-->

<div class=\"col-lg-6 col-xs-12 panel-options wow fadeIn\">
    <div class=\"panel-heading\">
        <h3>Options</h3>
    </div>

    <div class=\"panel-body\">
        <ul class=\"timeline\">
            <li>
                <div class=\"timeline-badge\">
                    <img class=\"img-panel-options\" src=\"/bundles/app/default/images/icon-integration.png\">
                </div>
                <div class=\"timeline-panel\">
                    <div class=\"timeline-heading\">
                        <h4 class=\"timeline-title\">Gateway Integration</h4>
                    </div>
                    <div class=\"timeline-body\">
                        <p class=\"number-panel\"> 750 €</p>
                    </div>
                </div>
            </li>
            <li class=\"timeline-inverted\">
                <div class=\"timeline-badge warning\">
                    <img class=\"img-panel-options\" src=\"/bundles/app/default/images/icon-skin.png\">
                </div>
                <div class=\"timeline-panel\">
                    <div class=\"timeline-heading\">
                        <h4 class=\"timeline-title\">Skin customization</h4>
                    </div>
                    <div class=\"timeline-body\">
                        <p class=\"number-panel\"> 500€/ <small>skin</small></p>
                    </div>
                </div>
            </li>
            <li>
                <div class=\"timeline-badge danger\">
                    <img class=\"img-panel-options\" src=\"/bundles/app/default/images/icon-localization.png\">
                </div>
                <div class=\"timeline-panel\">
                    <div class=\"timeline-heading\">
                        <h4 class=\"timeline-title\">Localization up to 1000 words</h4>
                    </div>
                    <div class=\"timeline-body\">
                        <p class=\"number-panel\">300€/ <small>Language</small></p>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>


<div class=\"col-lg-6 col-xs-12\">
    <!-- /.panel-heading -->
    <div class=\"panel-body panel-example\">
        <div class=\"table-responsive wow fadeInRight\" data-wow-delay=\".6s\">
            <table class=\"table table-striped-custom table-bordered-example table-hover-custom\">
                <thead>
                <tr>
                    <th class=\"example-tab-top text-center\">EXAMPLE OF PAYMENT METHODS</th>
                    <th class=\"example-tab-top text-center\">Volume Fee</th>
                    <th class=\"example-tab-top text-center\">Per Transaction Fee</th>
                </tr>
                </thead>
                <tbody>
                <tr class=\"example-tab\">
                    <td class=\"text-left\" >Credit Cards*</td>
                    <td class=\"border-mini\">0.60%</td>
                    <td>0.10 €</td>
                </tr>
                <tr class=\"example-tab\">
                    <td class=\"text-left\">PayPal</td>
                    <td class=\"border-mini\">3.40%</td>
                    <td>0.34 €</td>
                </tr>
                <tr class=\"example-tab\">
                    <td class=\"text-left\">PaySafeCard</td>
                    <td class=\"border-mini\">11.00%</td>
                    <td>0</td>
                </tr>
                <tr class=\"example-tab\">
                    <td class=\"text-left\">Neteller</td>
                    <td class=\"border-mini\">3.40%</td>
                    <td>0.50 €</td>
                </tr>
                <tr class=\"example-tab\">
                    <td class=\"text-left\">Skrill Wallet</td>
                    <td class=\"border-mini\">3.90%</td>
                    <td>0.29 €</td>
                </tr>
                <tr class=\"example-tab\">
                    <td class=\"text-left\">iDeal</td>
                    <td class=\"border-mini\">2.50%</td>
                    <td>0.29 €</td>
                </tr>
                <tr class=\"example-tab\">
                    <td class=\"text-left\">Trustly</td>
                    <td class=\"border-mini\">2.50%</td>
                    <td>0.29 €</td>
                </tr>
                <tr class=\"example-tab\">
                    <td class=\"text-left\">Boleto Bancario</td>
                    <td class=\"border-mini\">6.99%</td>
                    <td>1 €</td>
                </tr>
                <tr class=\"example-tab\">
                    <td class=\"text-left\">Multibanco</td>
                    <td class=\"border-mini\">6.99%</td>
                    <td>1 €</td>
                </tr>
                <tr class=\"example-tab\">
                    <td class=\"text-left\">Itaú</td>
                    <td class=\"border-mini\">15.00%</td>
                    <td>1 €</td>
                </tr>
                <tr class=\"example-tab\">
                    <td class=\"text-left\">BoaCompra Gold Credits</td>
                    <td class=\"border-mini\">9.99%</td>
                    <td>1 €</td>
                </tr>
                <tr class=\"example-tab\">
                    <td class=\"text-left\"><small class=\"small-tab\">EloCard, Hipercard, Aura, Personal Card, Pleno Card (Brasil)</small></td>
                    <td class=\"border-mini\">6.99%</td>
                    <td>1 €</td>
                </tr>
                <tr class=\"example-tab\">
                    <td class=\"text-left\">OXXO</td>
                    <td class=\"border-mini\">15.00%</td>
                    <td>1 €</td>
                </tr>
                <tr class=\"example-tab\">
                    <td class=\"text-left\">Cherry Credits</td>
                    <td class=\"border-mini\">30.00%</td>
                    <td>0</td>
                </tr>
                <tr class=\"example-tab\">
                    <td class=\"text-left\">Qiwi</td>
                    <td class=\"border-mini\">12.00%</td>
                    <td>0</td>
                </tr>

                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.panel-body -->
    <span class=\"text-right\">(*) Visa, MasterCard, Maestro, American Express, JCB, UnionPay, Diners</span>
</div>
<!-- /.panel -->


</div>

</div>
</div>
</div>
</section>

<section id=\"company\">
    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-lg-12 text-center\">
                <h2 class=\"margin-top-0 text-primary\">About Us / Company</h2>
                <hr>
                <div class=\"col-xs-12 col-md-6 info-step1\">
                    <h2 class=\"wow fadeInLeft\">Wolopay is part of Nvia, a multinational company specialised in</h2>
                    <div class=\"col-xs-12 logo-nvia wow fadeIn\" data-wow-delay=\".3s\">
                        <img class=\"img-responsive center-inline\" src=\"/bundles/app/default/images/info-step1.png\" alt=\"\">
                    </div>
                    <div class=\"col-xs-12 wow fadeInDown\" data-wow-delay=\".6s\">
                        <div class=\"circle-purple center-block\"> <p>TELECOM<br><small>TECHNOLOGIES</small></p></div>
                        <div class=\"circle-blue center-block\"><p>PAYMENT<br><small>SOLUTIONS</small></p></div>
                        <div class=\"circle-yellow center-block\"><p><small>ONLINE & MOBILE</small><br>MARKETING</p></div>
                    </div>

                    <div class=\"col-xs-12 years\">
                        <div class=\"col-xs-12 wow fadeIn\" data-wow-delay=\".3s\">
                            <img class=\"img-responsive center-inline\" src=\"/bundles/app/default/images/info-step4.png\">
                        </div>
                        <div class=\"col-xs-12 timeline-panel text-left\">
                            <div class=\"timeline-heading wow fadeInRight\" data-wow-delay=\".6s\">
                                <h4 class=\"timeline-title\">14</h4>
                            </div>
                            <div class=\"timeline-body wow fadeInLeft\" data-wow-delay=\".9s\">
                                <p>years of experience</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class=\"col-xs-12 col-md-6 info-step2\">
                    <h2 class=\"text-right wow fadeInLeft\"><span class=\"yellow-text\">+20</span> offices worldwide </h2>
                    <img class=\"img-responsive center-inline wow fadeInUp\" data-wow-delay=\".3s\" src=\"/bundles/app/default/images/info-step2.png\" alt=\"\">
                    <div class=\"col-xs-12 hq wow fadeInRight\" data-wow-delay=\".6s\">
                        <h3 class=\"text-left\"><span class=\"yellow-text\">HQ</span></h3>
                        <ul>
                            <li class=\"text-left red-city\"><h4>Madrid</h4></li>
                            <li class=\"text-left yellow-city\"><h4>Santiago de Chile</h4></li>
                            <li class=\"text-left green-city\"><h4>Singapore</h4></li>
                            <li class=\"text-left blue-city\"><h4>Johannesburg</h4></li>
                        </ul>
                    </div>


                    <div class=\"col-xs-12 employees\">
                        <div class=\"col-xs-12 col-md-6 wow fadeInDown\" data-wow-delay=\".9s\">
                            <img class=\"img-responsive center-inline\" src=\"/bundles/app/default/images/info-step3.png\">
                        </div>
                        <div class=\"col-xs-12 col-md-6 timeline-panel wow fadeInRight\" data-wow-delay=\".9s\">
                            <div class=\"timeline-heading\">
                                <h4 class=\"timeline-title\">+100</h4>
                            </div>
                            <div class=\"timeline-body\">
                                <p>employees</p>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
</section>

<section id=\"contact\">
    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-lg-8 col-lg-offset-2 text-center\">
                <h2 class=\"margin-top-0 text-primary wow fadeIn\">Contact</h2>
                <hr class=\"primary\">
                <p class=\"text-faded\">We love feedback. Fill out the form below and we'll get back to you as soon as possible.</p>
            </div>
            <div class=\"col-lg-10 col-lg-offset-1 text-center\">
                <div class=\"container\">
                    ";
        // line 719
        $this->loadTemplate("@App/Others/Default/contactSimpleForm.html.twig", "AppBundle:Others/Default:index.html.twig", 719)->display(array_merge($context, array("form" => (isset($context["contactFrom"]) ? $context["contactFrom"] : $this->getContext($context, "contactFrom")))));
        // line 720
        echo "                </div>
            </div>
        </div>
    </div>
</section>

<footer id=\"footer\">
    <div class=\"container-fluid\">
        <div class=\"row\">
            <!--<div class=\"col-xs-6 col-sm-3 column\">
                <h4>Information</h4>
                <ul class=\"list-unstyled\">
                    <li><a href=\"\">Products</a></li>
                    <li><a href=\"\">Services</a></li>
                    <li><a href=\"\">Benefits</a></li>
                    <li><a href=\"\">Developers</a></li>
                </ul>
            </div>-->
            <div class=\"col-xs-12 content-nav-pills\">
                <ul class=\"nav nav-pills\">
                    <li><a href=\"";
        // line 740
        echo $this->env->getExtension('routing')->getPath("privacy_policy");
        echo "\" target=\"_blank\">Privacy Policy</a></li>
                    <li><a href=\"";
        // line 741
        echo $this->env->getExtension('routing')->getPath("terms_conditions");
        echo "\" target=\"_blank\">Terms &amp; Conditions</a></li>
                    <li><a href=\"";
        // line 742
        echo $this->env->getExtension('routing')->getPath("legal_notice");
        echo "\" target=\"_blank\">Legal Notice</a></li>
                </ul>
            </div>
            <!--<div class=\"col-xs-12 col-sm-3 column\">
                <h4>Stay Posted</h4>
                <form>
                    <div class=\"form-group\">
                      <input type=\"text\" class=\"form-control\" title=\"No spam, we promise!\" placeholder=\"Tell us your email\">
                    </div>
                    <div class=\"form-group\">
                      <button class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#alertModal\" type=\"button\">Subscribe for updates</button>
                    </div>
                </form>
            </div>-->
            <!--<div class=\"col-xs-12 col-sm-3 text-right\">
                <h4>Follow</h4>
                <ul class=\"list-inline\">
                  <li><a rel=\"nofollow\" href=\"\" title=\"Twitter\"><i class=\"icon-lg ion-social-twitter-outline\"></i></a>&nbsp;</li>
                  <li><a rel=\"nofollow\" href=\"\" title=\"Facebook\"><i class=\"icon-lg ion-social-facebook-outline\"></i></a>&nbsp;</li>
                  <li><a rel=\"nofollow\" href=\"\" title=\"Dribble\"><i class=\"icon-lg ion-social-dribbble-outline\"></i></a></li>
                </ul>
            </div>-->
        </div>
        <span style=\"color: #c3c3c3;\" class=\"col-xs-12 text-center small\">Wolopay ©2015 All rights reserved</span>
    </div>
</footer>
<div id=\"galleryModal\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-lg\">
        <div class=\"modal-content\">
            <div class=\"modal-body\">
                <img src=\"//placehold.it/1200x700/222?text=...\" id=\"galleryImage\" class=\"img-responsive\" />
                <p>
                    <br/>
                    <button class=\"btn btn-primary btn-lg center-block\" data-dismiss=\"modal\" aria-hidden=\"true\">Close <i class=\"ion-android-close\"></i></button>
                </p>
            </div>
        </div>
    </div>
</div>
<div id=\"alert-modal-contact\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-sm\">
        <div class=\"modal-content\">
            <div class=\"modal-body\">
                <p class=\"text-center\">";
        // line 785
        echo $this->env->getExtension('translator')->trans("email_was_sent_and_we_will_contact", array(), "default");
        echo "</p>
                <br/>
                <button class=\"btn btn-primary btn-lg center-block\" data-dismiss=\"modal\" aria-hidden=\"true\">OK <i class=\"ion-android-close\"></i></button>
            </div>
        </div>
    </div>
</div>
<!--scripts loaded here from cdn for performance -->
<script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js\"></script>
<script src=\"//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js\"></script>
<script src=\"//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js\"></script>
<script src=\"//cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.js\"></script>

";
        // line 798
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "7d6e405_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_7d6e405_0") : $this->env->getExtension('asset')->getAssetUrl("js/7d6e405_scripts_1.js");
            // line 802
            echo "    <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
";
            // asset "7d6e405_1"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_7d6e405_1") : $this->env->getExtension('asset')->getAssetUrl("js/7d6e405_lightbox_2.js");
            echo "    <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
";
        } else {
            // asset "7d6e405"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_7d6e405") : $this->env->getExtension('asset')->getAssetUrl("js/7d6e405.js");
            echo "    <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
";
        }
        unset($context["asset_url"]);
        // line 804
        echo "<!-- ";
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "d/m/Y H:i:s"), "html", null, true);
        echo " -->
</body>
</html>";
        
        $__internal_608dbef8870f6b399f4e9fad07908dffe4f6dbc35ffe7732a292a16571cb75c6->leave($__internal_608dbef8870f6b399f4e9fad07908dffe4f6dbc35ffe7732a292a16571cb75c6_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Others/Default:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  921 => 804,  901 => 802,  897 => 798,  881 => 785,  835 => 742,  831 => 741,  827 => 740,  805 => 720,  803 => 719,  215 => 134,  208 => 130,  180 => 105,  170 => 98,  98 => 28,  96 => 27,  91 => 24,  53 => 22,  49 => 15,  42 => 11,  36 => 8,  32 => 7,  28 => 6,  22 => 2,);
    }
}
/* {% trans_default_domain "default" %}*/
/* <!DOCTYPE html>*/
/* <html>*/
/* <head>*/
/*     <meta charset="utf-8">*/
/*     <title>{{ 'meta_title' |trans |raw }}</title>*/
/*     <meta name="description" content="{{ 'meta_description' |trans|raw }}" />*/
/*     <meta name="keywords" content="{{ 'meta_keywords' |trans|raw }}" />*/
/*     <meta name="viewport" content="width=device-width, initial-scale=1.0">*/
/*     <meta property='og:title' content='Online Payments | Wolopay'/>*/
/*     <meta property='og:description' content='{{ 'meta_description' | trans | raw }}'/>*/
/*     <meta property='og:url' content='https://wolopay.com'/>*/
/*     <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">*/
/* */
/*     {% stylesheets*/
/*         '@AppBundle/Resources/public/default/css/animate.min.css'*/
/*         '@AppBundle/Resources/public/default/css/ionicons.less'*/
/*         '@AppBundle/Resources/public/default/css/styles.less'*/
/*         '@AppBundle/Resources/public/default/css/styles_media.less'*/
/*         'css_glob/bootstrap_extra.css'*/
/*     %}*/
/*         <link rel="stylesheet" href="{{ asset_url }}" media="screen" />*/
/*     {% endstylesheets %}*/
/* */
/* </head>*/
/* <body>*/
/* {% include '@App/Others/Default/partials/home_header.html.twig' %}*/
/* <header id="intro">*/
/*     <div class="header-content">*/
/*         <div class="inner">*/
/*             <div id="main-text">*/
/*                 <h1 class="wow fadeIn " data-wow-delay=".1s">The BEST Storefront Management </h1>*/
/*                 <h3 class="wow fadeIn " data-wow-delay=".8s">and</h3>*/
/*                 <h1 class="wow fadeInRight " data-wow-delay=".8s">Worldwide Payment Solutions Hub,</h1>*/
/*                 <h3 class="wow fadeIn " data-wow-delay=".9s">all</h3>*/
/*                 <h1 class="wow fadeInLeft" data-wow-delay=".9s">In one simple REST API</h1>*/
/*                 <hr>*/
/*                 <hr>*/
/*                 <hr>*/
/*                 <h2 class="wow fadeInRight" data-wow-delay="1s">Manage your what you sell in Web, Facebook, Steam...</h2>*/
/*                 <h2 class="wow fadeInLeft" data-wow-delay="1.1s">Start accepting payments worldwide seamlessly in your web, </h2>*/
/*                 <h2 class="wow fadeInRight" data-wow-delay="1.2s">and increase your revenues instantly!</h2>*/
/*             </div>*/
/*             <div id="video" style="display: none">*/
/*                 <iframe data-srcx="https://www.youtube.com/embed/QSKRY2ZYcOE?autoplay=1" frameborder="0" allowfullscreen></iframe>*/
/*             </div>*/
/*             <div id="header-buttons">*/
/*                 <button id="toggleVideo" data-toggle="collapse" class="btn btn-primary btn-xl">Watch Video</button> &nbsp;*/
/*                 <a href="#tryit" class="btn btn-primary btn-xl page-scroll">Try Wolopay</a>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* */
/* </header>*/
/* */
/* <section class="bg-primary" id="one">*/
/*     <div class="container">*/
/*         <div class="row">*/
/*             <div class="col-lg-12 col-md-8 text-justify ">*/
/*                 <h2 class="margin-top-0 text-primary h2-light wow fadeInUp">WORLDWIDE PAYMENT FOR YOUR PRODUCT</h2>*/
/*                 <br>*/
/*                 <p class="text-faded wow fadeIn">*/
/*                     Wolopay is the best and ultimate payment solution and storefront management for games. It’s an unparalleled unique Storefront management tool (or SaaS, Store as a Service) to include in your monetization strategy, in order to increase visits to your games’ shops and improve their conversion rates, (that is, to increase in-game or in-app purchases), joined with a global payment solution hub with worldwide coverage, thanks to its more than 300 payment methods integrated via different PSPs. It’s your games’ window to the world, perfectly integrated with their look and feel… where your users will be willing to pay, in their preferred payment method, in their local currency...*/
/*                 </p>*/
/*                 <p class="text-faded wow fadeIn">*/
/*                     Forget about having different payment solutions, aggregators, and integrations for different countries, selling packs of virtual currency, having to decide prices for them based on intuition… Forget about having to develop a shop in your side and manage what items you sell for the game, and in exchange of how much virtual currency! You can do it all in a single contract, integration, interface, and money flow, and with the help of experts:*/
/*                 </p>*/
/*                 <p class="text-faded wow fadeIn">*/
/*                     Wolopay is formed by a team of professionals that come from the gaming industry, and are specialized in monetization and payments; they will help you integrate the solution, and configure it to increase the visits to the shop, improve its effectiveness and profitability, and in the end, boost your conversion rates and incomes.*/
/*                 </p>*/
/*                 <p class="text-faded wow fadeIn">*/
/*                     Wolopay makes developers' lives easier when it comes to manage their shop, in-app articles, prices, offers, and accept payments in all the platforms for all of his games, worldwide. One integration will allow the games to have items, articles, packs, GACHAs, tabs, all localizations, prices, offers, coupons, a virtual currency, and of course stats, and many more things, all together. Additionally, Wolopay is a “payment hub”; a new concept of a payment solution: integrate with Wolopay and you will have solved at once your integration with STEAM, Facebook, the Chrome Webstore, and many more international stores!  One invoice, one transfer, and the developer will get all the money from all the platforms at once.  And everything within a web application with simple step-by-step wizards and easy to use menus.*/
/*                 </p>*/
/*                 <p class="text-faded wow fadeIn">*/
/*                     Let Wolopay be your storefront manager, your shopkeeper, offer programmer, coupon manager and your payment solution.  Let Wolopay be your window to the world and start increasing your sales and revenues.*/
/*                 </p>*/
/* */
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* </section>*/
/* */
/* <section id="tryit">*/
/*     <div class="container">*/
/*         <div class="row">*/
/*             <div class="col-lg-12 text-center">*/
/*                 <h2 class="margin-top-0 text-primary">Try it now!</h2>*/
/*                 <hr class="primary">*/
/*                 <br>*/
/*                 <p class="wow fadeIn">*/
/*                     Click here to see a real example of our impressive fully-flexible storefront and payment solution...*/
/*                 </p>*/
/*                 <div class="col-xs-12 center-block text-center btn-content wow fadeInDown" data-wow-delay=".3s" style="margin-bottom: 20px">*/
/*                     <div class="" role="group">*/
/*                         <span class="btn btn-info btn-xl page-scroll shop-iframe">*/
/*                             Shop iframe <i class="icon ion-ios-arrow-forward"></i>*/
/*                         </span>*/
/*                         <span onclick="woPlugin.open('{{ path('example_light_box') }}')" class="btn btn-warning btn-xl page-scroll shop-lightbox">*/
/*                             Shop lightbox <i class="icon ion-ios-arrow-forward "></i>*/
/*                         </span>*/
/*                         <span class="btn btn-special btn-xl widget payment-widget">*/
/*                             See a payment widget <i class="icon ion-ios-arrow-forward"></i>*/
/*                         </span>*/
/* */
/*                         <a target="_blank" href="https://sandbox.wolopay.com{{ path('try_control_panel') }}" class="btn btn-default btn-xl">*/
/*                             Control panel*/
/*                         </a>*/
/* */
/*                     </div>*/
/*                 </div>*/
/* */
/*                 <div id="iframe-shop-container" style="display: none">*/
/* */
/*                     <div class="devices" role="group">*/
/* */
/*                         <span class="btn laptop active">*/
/*                             <i class="icon ion-monitor"></i>*/
/*                         </span>*/
/* */
/*                         <span class="btn tablet">*/
/*                             <i class="icon ion-ipad"></i>*/
/*                         </span>*/
/* */
/*                         <span class="btn mobile ">*/
/*                             <i class="icon ion-iphone"></i>*/
/*                         </span>*/
/* */
/*                     </div>*/
/* */
/*                     <iframe id="iframe-shop" scrolling="no" data-srcx="{{ path('example') }}" style="width: 1020px; height: 1000px; overflow-y:hidden;"></iframe>*/
/* */
/*                 </div>*/
/* */
/*                 <iframe id="iframe-payment-widget" style="display: none" data-srcx="{{ path('example_payment_widget') }}"></iframe>*/
/* */
/*             </div>*/
/*         </div>*/
/*     </div>*/
/*     <div class="container">*/
/*         <div class="row">*/
/*             <!--<div class="col-lg-4 col-md-4 text-center">*/
/*                 <div class="feature">*/
/*                     <i class="icon-lg ion-android-laptop wow fadeIn" data-wow-delay=".3s"></i>*/
/*                     <h3>Game</h3>*/
/*                     <p class="text-muted">Your site looks good everywhere</p>*/
/*                 </div>*/
/*             </div>*/
/*             <div class="col-lg-4 col-md-4 text-center">*/
/*                 <div class="feature">*/
/*                     <i class="icon-lg ion-social-sass wow fadeInUp" data-wow-delay=".2s"></i>*/
/*                     <h3>Shop</h3>*/
/*                     <p class="text-muted">Easy to theme and customize with SASS</p>*/
/*                 </div>*/
/*             </div>*/
/*             <div class="col-lg-4 col-md-4 text-center">*/
/*                 <div class="feature">*/
/*                     <i class="icon-lg ion-ios-star-outline wow fadeIn" data-wow-delay=".3s"></i>*/
/*                     <h3>Selected tab "Card Set"</h3>*/
/*                     <p class="text-muted">A mature, well-tested, stable codebase</p>*/
/*                 </div>*/
/*             </div>-->*/
/* */
/*         </div>*/
/*     </div>*/
/* </section>*/
/* */
/* <section class="container-fluid" id="features">*/
/*     <div class="row">*/
/*         <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">*/
/*             <h2 class="text-center h2-light text-primary">Features</h2>*/
/*             <hr>*/
/*             <div class="col-lg-6 col-md-6 text-center">*/
/*                 <div class="media wow fadeInRight">*/
/*                     <div class="media-middle">*/
/*                         <i class="icon-lg ion-cash"></i>*/
/*                     </div>*/
/*                     <h3 class="text-secondary">Go Local:</h3>*/
/* */
/*                     <div class="media-body text-justify text-faded">*/
/*                         <p>+150 currencies: users see prices in their local currency, wherever.</p>*/
/*                         <p>+170 languages: show description of what you’re selling in users’ language.</p>*/
/*                         <p>Local payment methods to every country in the world (but including global credit cards, and recurring payments, of course!), ordered by popularity.</p>*/
/*                         <p>Wolopay patent pending  “Standard Of Living Automatic Adaptor”, to suggest (but not impose) local prices affordable to people in the country (instead of having prices as if everyone was from the United States, Germany or South Korea).</p>*/
/*                         <p>Don’t want to set-up different prices per country? Group the least important for you, per continent, and set-up a common price for them...</p>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/* */
/*             <div class="col-lg-6 col-md-6 text-center">*/
/*                 <div class="media wow fadeInLeft">*/
/*                     <div class="media-middle">*/
/*                         <i class="icon-lg ion-ios-gear-outline"></i>*/
/*                     </div>*/
/*                     <h3 class="text-secondary">Manage what you sell:</h3>*/
/*                     <div class="media-body media-middle text-justify text-faded">*/
/*                         <p>Wolopay advices customers with its monetization improvement knowledge, recommending best-practices, in an unmatched consultancy service, included in our monthly fee.</p>*/
/*                         <p>Create your items (can be virtual currency for one game or cross-game, or can be “resources” as wood, iron, silver, gold...) </p>*/
/*                         <p>Create articles with many different options like validity between dates, global or per-user limits, customized image and extended descriptions.</p>*/
/*                         <p>Create packs as sets of existing articles, or “random packs”.</p>*/
/*                         <p>Create different kinds of Gachas to increase conversion rates drastically.</p>*/
/*                         <p>Do you have multiple apps, plus one Virtual Currency that can be exchanged for items in your apps? We handle that too.</p>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*             <div class="col-lg-6 col-md-6 text-center">*/
/*                 <div class="media wow fadeInRight">*/
/*                     <div class="media-middle">*/
/*                         <i class="icon-lg ion-ios-pricetags-outline"></i>*/
/*                     </div>*/
/*                     <h3 class="text-secondary">Flexibly manage offers of your products:</h3>*/
/*                     <div class="media-body text-justify text-faded">*/
/*                         <p>Offer discount in prices, or increase the items given, or give extra articles…  or make your own mix.</p>*/
/*                         <p>Make offers valid for one or more countries...</p>*/
/*                         <p>Make the same offer in different articles at once (everything 20% off), or per article.</p>*/
/*                         <p>Create Seasonal Promotions and Gift codes.</p>*/
/*                         <p>Cross-platform, of course!</p>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*             <div class="col-lg-6 col-md-6 text-center">*/
/*                 <div class="media wow fadeInLeft">*/
/*                     <div class="media-middle">*/
/*                         <i class="icon-lg ion-ios-cog"></i>*/
/*                     </div>*/
/*                     <h3 class="text-secondary">We blend with your game:</h3>*/
/*                     <!--<div class="media-left">*/
/*                         <a href="#alertModal" data-toggle="modal" data-target="#alertModal"><i class="icon-lg ion-ios-cloud-download-outline"></i></a>*/
/*                     </div>-->*/
/*                     <div class="media-body media-middle text-justify text-faded">*/
/*                         <p>Flexible, fully configurable Skins for your shops: Integrate seamlessly in mobile, tablet or web automatically: no extra integration or configuration.</p>*/
/*                         <p>Categorize your articles and group them into “tabs” to make them easy to find .</p>*/
/*                         <p>Configure different “shops” depending on users’ level… Newbies won’t see the same tabs, articles, prices, or even offers, as expert users.</p>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/* */
/* */
/*         </div>*/
/*     </div>*/
/* </section>*/
/* */
/* <section id="pricing" >*/
/* <div class="container">*/
/* <div class="row">*/
/* <div class="col-lg-12 text-center">*/
/* <h2 class="margin-top-0 text-primary">Pricing</h2>*/
/* <br>*/
/* <div class="col-lg-12">*/
/* <div class="panel panel-default panel-wolopay-offer">*/
/*     <div class="panel-heading">*/
/*         <h3>Wolopay Offer</h3>*/
/*     </div>*/
/*     <!-- /.panel-heading -->*/
/*     <div class="panel-body">*/
/*         <div class="table-responsive wow fadeInLeft">*/
/*             <table class="table table-striped-custom table-bordered table-hover-custom">*/
/*                 <thead>*/
/*                 <tr>*/
/*                     <th></th>*/
/*                     <th class="mini-tab text-center border-mini">Mini</th>*/
/*                     <th class="developer-tab text-center">Developer</th>*/
/*                     <th class="publisher-tab text-center">Publisher</th>*/
/*                     <th class="premium-tab text-center">Premium Platinum Partner</th>*/
/*                 </tr>*/
/*                 </thead>*/
/*                 <tbody>*/
/*                 <tr class="offer-tab">*/
/*                     <td class="text-left">Pay Methods</td>*/
/*                     <td class="border-mini">All</td>*/
/*                     <td>All</td>*/
/*                     <td>All</td>*/
/*                     <td>All</td>*/
/*                 </tr>*/
/*                 <tr class="offer-tab">*/
/*                     <td class="text-left">Dedicated Gateways</td>*/
/*                     <td class="border-mini">-</td>*/
/*                     <td>-</td>*/
/*                     <td>Yes, for Wolopay existing ones(*)</td>*/
/*                     <td>Yes, plus up to 3 integrations on demand</td>*/
/*                 </tr>*/
/*                 <tr class="offer-tab">*/
/*                     <td class="text-left">Risk & Fraud Control</td>*/
/*                     <td class="border-mini">Included</td>*/
/*                     <td>Included</td>*/
/*                     <td>Included</td>*/
/*                     <td>Included</td>*/
/*                 </tr>*/
/*                 <tr class="offer-tab">*/
/*                     <td class="text-left">Items</td>*/
/*                     <td class="border-mini">Unlimited</td>*/
/*                     <td>Unlimited</td>*/
/*                     <td>Unlimited</td>*/
/*                     <td>Unlimited</td>*/
/*                 </tr>*/
/*                 <tr class="offer-tab">*/
/*                     <td class="text-left">Articles</td>*/
/*                     <td class="border-mini">Unlimited</td>*/
/*                     <td>Unlimited</td>*/
/*                     <td>Unlimited</td>*/
/*                     <td>Unlimited</td>*/
/*                 </tr>*/
/*                 <tr class="offer-tab">*/
/*                     <td class="text-left">Offers</td>*/
/*                     <td class="border-mini">Unlimited</td>*/
/*                     <td>Unlimited</td>*/
/*                     <td>Unlimited</td>*/
/*                     <td>Unlimited</td>*/
/*                 </tr>*/
/*                 <tr class="offer-tab">*/
/*                     <td class="text-left">Coupons</td>*/
/*                     <td class="border-mini">-</td>*/
/*                     <td>Unlimited</td>*/
/*                     <td>Unlimited</td>*/
/*                     <td>Unlimited + API Available</td>*/
/*                 </tr>*/
/*                 <tr class="offer-tab">*/
/*                     <td class="text-left">Tutorial for end-users</td>*/
/*                     <td class="border-mini">-</td>*/
/*                     <td>Yes</td>*/
/*                     <td>Yes, plus promotional code</td>*/
/*                     <td>Yes, plus promotional code</td>*/
/*                 </tr>*/
/*                 <tr class="offer-tab">*/
/*                     <td class="text-left">Blacklisting</td>*/
/*                     <td class="border-mini">-</td>*/
/*                     <td>Country, IP, User Id</td>*/
/*                     <td>Country, IP, User Id</td>*/
/*                     <td>Country, IP, User Id</td>*/
/*                 </tr>*/
/*                 <tr class="offer-tab">*/
/*                     <td class="text-left">Number of Countries & Currencies</td>*/
/*                     <td class="border-mini">10</td>*/
/*                     <td>Unlimited</td>*/
/*                     <td>Unlimited</td>*/
/*                     <td>Unlimited</td>*/
/*                 </tr>*/
/*                 <tr class="offer-tab">*/
/*                     <td class="text-left">Country Grouping per Area</td>*/
/*                     <td class="border-mini">No</td>*/
/*                     <td>1 Area</td>*/
/*                     <td>Unlimited</td>*/
/*                     <td>Unlimited</td>*/
/*                 </tr>*/
/*                 <tr class="offer-tab">*/
/*                     <td class="text-left">Number of Languages</td>*/
/*                     <td class="border-mini">10</td>*/
/*                     <td>Unlimited</td>*/
/*                     <td>Unlimited</td>*/
/*                     <td>Unlimited</td>*/
/*                 </tr>*/
/*                 <tr class="offer-tab">*/
/*                     <td class="text-left">Apps</td>*/
/*                     <td class="border-mini">1</td>*/
/*                     <td>3</td>*/
/*                     <td>10</td>*/
/*                     <td>Unlimited</td>*/
/*                 </tr>*/
/*                 <tr class="offer-tab">*/
/*                     <td class="text-left">Shops</td>*/
/*                     <td class="border-mini">1</td>*/
/*                     <td>1 per App</td>*/
/*                     <td>5 per App</td>*/
/*                     <td>5 per App</td>*/
/*                 </tr>*/
/*                 <tr class="offer-tab">*/
/*                     <td class="text-left">Customized Skins</td>*/
/*                     <td class="border-mini">1</td>*/
/*                     <td>Up to 3 per App</td>*/
/*                     <td>Up to 3 per App and Shop</td>*/
/*                     <td>Unlimited</td>*/
/*                 </tr>*/
/*                 <tr class="offer-tab">*/
/*                     <td class="text-left">Tabs</td>*/
/*                     <td class="border-mini">1</td>*/
/*                     <td>3 per App</td>*/
/*                     <td>Unlimited</td>*/
/*                     <td>Unlimited</td>*/
/*                 </tr>*/
/*                 <tr class="offer-tab">*/
/*                     <td class="text-left">Virtual Currency & e-Wallet</td>*/
/*                     <td class="border-mini">-</td>*/
/*                     <td>Per App</td>*/
/*                     <td>Per App</td>*/
/*                     <td>Valid within All Apps</td>*/
/*                 </tr>*/
/*                 <tr class="offer-tab">*/
/*                     <td class="text-left">Affiliate Sales Stats</td>*/
/*                     <td class="border-mini">-</td>*/
/*                     <td>Yes</td>*/
/*                     <td>Yes</td>*/
/*                     <td>Yes</td>*/
/*                 </tr>*/
/*                 <tr class="offer-tab">*/
/*                     <td class="text-left">Extended User Info for Stats</td>*/
/*                     <td class="border-mini">-</td>*/
/*                     <td>-</td>*/
/*                     <td>Yes, via API</td>*/
/*                     <td>Yes, via API</td>*/
/*                 </tr>*/
/*                 <tr class="offer-tab">*/
/*                     <td class="text-left">Cost per succesful transaction</td>*/
/*                     <td class="border-mini">0,15 €</td>*/
/*                     <td>0,12 €</td>*/
/*                     <td>0,10 €</td>*/
/*                     <td>0,05 €</td>*/
/*                 </tr>*/
/*                 <tr class="offer-tab">*/
/*                     <td class="text-left">Minimum transactions</td>*/
/*                     <td class="border-mini">500</td>*/
/*                     <td>0</td>*/
/*                     <td>0</td>*/
/*                     <td>0</td>*/
/*                 </tr>*/
/*                 <tr class="offer-tab">*/
/*                     <td class="price-tab">PRICE</td>*/
/*                     <td class="mini-tab-bot">3 MONTHS TRIAL FOR FREE (**)</td>*/
/*                     <td class="developer-tab-bot">100€/MONTH</td>*/
/*                     <td class="publisher-tab-bot">150€/MONTH BEST OPTION</td>*/
/*                     <td class="premium-tab-bot">750 €/MONTH</td>*/
/*                 </tr>*/
/*                 </tbody>*/
/*             </table>*/
/*         </div>*/
/*         <!-- /.table-responsive -->*/
/*     </div>*/
/*     <!-- /.panel-body -->*/
/*     <span class="text-right">(*) Existing Gateways (Steam, Facebook, Paypal, Adyen, Neteller, PaySafeCard, G2APay)</span><br>*/
/*     <span class="text-right">(**) Minimum transactions waived during first 3 months</span>*/
/* </div>*/
/* <!-- /.panel -->*/
/* */
/* */
/* */
/* <div class="row content-panel-offer">*/
/*     <div class="col-lg-4 col-sm-4 col-xs-12 ">*/
/*         <div class="panel panel-offer">*/
/*             <div class="panel-heading">*/
/*                 <div class="row">*/
/*                     <div class="col-xs-3 wow fadeInUp">*/
/*                         <img class="img-panel-offer" src="/bundles/app/default/images/icon-chargebacks.png">*/
/*                     </div>*/
/*                     <div class="col-xs-9 text-right wow fadeIn" data-wow-delay=".3s">*/
/*                         <div class="number-panel">15 €</div>*/
/*                         <div class="text-panel">Chargebacks</div>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/*     <div class="col-lg-4 col-sm-4 col-xs-12">*/
/*         <div class="panel panel-offer">*/
/*             <div class="panel-heading">*/
/*                 <div class="row">*/
/*                     <div class="col-xs-3 wow fadeInUp">*/
/*                         <img class="img-panel-offer" src="/bundles/app/default/images/icon-exchange.png">*/
/*                     </div>*/
/*                     <div class="col-xs-9 text-right wow fadeIn" data-wow-delay=".3s">*/
/*                         <div class="number-panel">2.50%</div>*/
/*                         <div class="text-panel">Currency Exchange</div>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/*     <div class="col-lg-4 col-sm-4 col-xs-12">*/
/*         <div class="panel panel-offer">*/
/*             <div class="panel-heading">*/
/*                 <div class="row">*/
/*                     <div class="col-xs-3 wow fadeInUp">*/
/*                         <img class="img-panel-offer" src="/bundles/app/default/images/icon-refunds.png">*/
/*                     </div>*/
/*                     <div class="col-xs-9 text-right wow fadeIn" data-wow-delay=".3s">*/
/*                         <div class="number-panel">0.10€</div>*/
/*                         <div class="text-panel">Refunds</div>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* <!-- /.panel offer-->*/
/* */
/* <div class="col-lg-6 col-xs-12 panel-options wow fadeIn">*/
/*     <div class="panel-heading">*/
/*         <h3>Options</h3>*/
/*     </div>*/
/* */
/*     <div class="panel-body">*/
/*         <ul class="timeline">*/
/*             <li>*/
/*                 <div class="timeline-badge">*/
/*                     <img class="img-panel-options" src="/bundles/app/default/images/icon-integration.png">*/
/*                 </div>*/
/*                 <div class="timeline-panel">*/
/*                     <div class="timeline-heading">*/
/*                         <h4 class="timeline-title">Gateway Integration</h4>*/
/*                     </div>*/
/*                     <div class="timeline-body">*/
/*                         <p class="number-panel"> 750 €</p>*/
/*                     </div>*/
/*                 </div>*/
/*             </li>*/
/*             <li class="timeline-inverted">*/
/*                 <div class="timeline-badge warning">*/
/*                     <img class="img-panel-options" src="/bundles/app/default/images/icon-skin.png">*/
/*                 </div>*/
/*                 <div class="timeline-panel">*/
/*                     <div class="timeline-heading">*/
/*                         <h4 class="timeline-title">Skin customization</h4>*/
/*                     </div>*/
/*                     <div class="timeline-body">*/
/*                         <p class="number-panel"> 500€/ <small>skin</small></p>*/
/*                     </div>*/
/*                 </div>*/
/*             </li>*/
/*             <li>*/
/*                 <div class="timeline-badge danger">*/
/*                     <img class="img-panel-options" src="/bundles/app/default/images/icon-localization.png">*/
/*                 </div>*/
/*                 <div class="timeline-panel">*/
/*                     <div class="timeline-heading">*/
/*                         <h4 class="timeline-title">Localization up to 1000 words</h4>*/
/*                     </div>*/
/*                     <div class="timeline-body">*/
/*                         <p class="number-panel">300€/ <small>Language</small></p>*/
/*                     </div>*/
/*                 </div>*/
/*             </li>*/
/*         </ul>*/
/*     </div>*/
/* </div>*/
/* */
/* */
/* <div class="col-lg-6 col-xs-12">*/
/*     <!-- /.panel-heading -->*/
/*     <div class="panel-body panel-example">*/
/*         <div class="table-responsive wow fadeInRight" data-wow-delay=".6s">*/
/*             <table class="table table-striped-custom table-bordered-example table-hover-custom">*/
/*                 <thead>*/
/*                 <tr>*/
/*                     <th class="example-tab-top text-center">EXAMPLE OF PAYMENT METHODS</th>*/
/*                     <th class="example-tab-top text-center">Volume Fee</th>*/
/*                     <th class="example-tab-top text-center">Per Transaction Fee</th>*/
/*                 </tr>*/
/*                 </thead>*/
/*                 <tbody>*/
/*                 <tr class="example-tab">*/
/*                     <td class="text-left" >Credit Cards*</td>*/
/*                     <td class="border-mini">0.60%</td>*/
/*                     <td>0.10 €</td>*/
/*                 </tr>*/
/*                 <tr class="example-tab">*/
/*                     <td class="text-left">PayPal</td>*/
/*                     <td class="border-mini">3.40%</td>*/
/*                     <td>0.34 €</td>*/
/*                 </tr>*/
/*                 <tr class="example-tab">*/
/*                     <td class="text-left">PaySafeCard</td>*/
/*                     <td class="border-mini">11.00%</td>*/
/*                     <td>0</td>*/
/*                 </tr>*/
/*                 <tr class="example-tab">*/
/*                     <td class="text-left">Neteller</td>*/
/*                     <td class="border-mini">3.40%</td>*/
/*                     <td>0.50 €</td>*/
/*                 </tr>*/
/*                 <tr class="example-tab">*/
/*                     <td class="text-left">Skrill Wallet</td>*/
/*                     <td class="border-mini">3.90%</td>*/
/*                     <td>0.29 €</td>*/
/*                 </tr>*/
/*                 <tr class="example-tab">*/
/*                     <td class="text-left">iDeal</td>*/
/*                     <td class="border-mini">2.50%</td>*/
/*                     <td>0.29 €</td>*/
/*                 </tr>*/
/*                 <tr class="example-tab">*/
/*                     <td class="text-left">Trustly</td>*/
/*                     <td class="border-mini">2.50%</td>*/
/*                     <td>0.29 €</td>*/
/*                 </tr>*/
/*                 <tr class="example-tab">*/
/*                     <td class="text-left">Boleto Bancario</td>*/
/*                     <td class="border-mini">6.99%</td>*/
/*                     <td>1 €</td>*/
/*                 </tr>*/
/*                 <tr class="example-tab">*/
/*                     <td class="text-left">Multibanco</td>*/
/*                     <td class="border-mini">6.99%</td>*/
/*                     <td>1 €</td>*/
/*                 </tr>*/
/*                 <tr class="example-tab">*/
/*                     <td class="text-left">Itaú</td>*/
/*                     <td class="border-mini">15.00%</td>*/
/*                     <td>1 €</td>*/
/*                 </tr>*/
/*                 <tr class="example-tab">*/
/*                     <td class="text-left">BoaCompra Gold Credits</td>*/
/*                     <td class="border-mini">9.99%</td>*/
/*                     <td>1 €</td>*/
/*                 </tr>*/
/*                 <tr class="example-tab">*/
/*                     <td class="text-left"><small class="small-tab">EloCard, Hipercard, Aura, Personal Card, Pleno Card (Brasil)</small></td>*/
/*                     <td class="border-mini">6.99%</td>*/
/*                     <td>1 €</td>*/
/*                 </tr>*/
/*                 <tr class="example-tab">*/
/*                     <td class="text-left">OXXO</td>*/
/*                     <td class="border-mini">15.00%</td>*/
/*                     <td>1 €</td>*/
/*                 </tr>*/
/*                 <tr class="example-tab">*/
/*                     <td class="text-left">Cherry Credits</td>*/
/*                     <td class="border-mini">30.00%</td>*/
/*                     <td>0</td>*/
/*                 </tr>*/
/*                 <tr class="example-tab">*/
/*                     <td class="text-left">Qiwi</td>*/
/*                     <td class="border-mini">12.00%</td>*/
/*                     <td>0</td>*/
/*                 </tr>*/
/* */
/*                 </tbody>*/
/*             </table>*/
/*         </div>*/
/*         <!-- /.table-responsive -->*/
/*     </div>*/
/*     <!-- /.panel-body -->*/
/*     <span class="text-right">(*) Visa, MasterCard, Maestro, American Express, JCB, UnionPay, Diners</span>*/
/* </div>*/
/* <!-- /.panel -->*/
/* */
/* */
/* </div>*/
/* */
/* </div>*/
/* </div>*/
/* </div>*/
/* </section>*/
/* */
/* <section id="company">*/
/*     <div class="container">*/
/*         <div class="row">*/
/*             <div class="col-lg-12 text-center">*/
/*                 <h2 class="margin-top-0 text-primary">About Us / Company</h2>*/
/*                 <hr>*/
/*                 <div class="col-xs-12 col-md-6 info-step1">*/
/*                     <h2 class="wow fadeInLeft">Wolopay is part of Nvia, a multinational company specialised in</h2>*/
/*                     <div class="col-xs-12 logo-nvia wow fadeIn" data-wow-delay=".3s">*/
/*                         <img class="img-responsive center-inline" src="/bundles/app/default/images/info-step1.png" alt="">*/
/*                     </div>*/
/*                     <div class="col-xs-12 wow fadeInDown" data-wow-delay=".6s">*/
/*                         <div class="circle-purple center-block"> <p>TELECOM<br><small>TECHNOLOGIES</small></p></div>*/
/*                         <div class="circle-blue center-block"><p>PAYMENT<br><small>SOLUTIONS</small></p></div>*/
/*                         <div class="circle-yellow center-block"><p><small>ONLINE & MOBILE</small><br>MARKETING</p></div>*/
/*                     </div>*/
/* */
/*                     <div class="col-xs-12 years">*/
/*                         <div class="col-xs-12 wow fadeIn" data-wow-delay=".3s">*/
/*                             <img class="img-responsive center-inline" src="/bundles/app/default/images/info-step4.png">*/
/*                         </div>*/
/*                         <div class="col-xs-12 timeline-panel text-left">*/
/*                             <div class="timeline-heading wow fadeInRight" data-wow-delay=".6s">*/
/*                                 <h4 class="timeline-title">14</h4>*/
/*                             </div>*/
/*                             <div class="timeline-body wow fadeInLeft" data-wow-delay=".9s">*/
/*                                 <p>years of experience</p>*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/* */
/*                 <div class="col-xs-12 col-md-6 info-step2">*/
/*                     <h2 class="text-right wow fadeInLeft"><span class="yellow-text">+20</span> offices worldwide </h2>*/
/*                     <img class="img-responsive center-inline wow fadeInUp" data-wow-delay=".3s" src="/bundles/app/default/images/info-step2.png" alt="">*/
/*                     <div class="col-xs-12 hq wow fadeInRight" data-wow-delay=".6s">*/
/*                         <h3 class="text-left"><span class="yellow-text">HQ</span></h3>*/
/*                         <ul>*/
/*                             <li class="text-left red-city"><h4>Madrid</h4></li>*/
/*                             <li class="text-left yellow-city"><h4>Santiago de Chile</h4></li>*/
/*                             <li class="text-left green-city"><h4>Singapore</h4></li>*/
/*                             <li class="text-left blue-city"><h4>Johannesburg</h4></li>*/
/*                         </ul>*/
/*                     </div>*/
/* */
/* */
/*                     <div class="col-xs-12 employees">*/
/*                         <div class="col-xs-12 col-md-6 wow fadeInDown" data-wow-delay=".9s">*/
/*                             <img class="img-responsive center-inline" src="/bundles/app/default/images/info-step3.png">*/
/*                         </div>*/
/*                         <div class="col-xs-12 col-md-6 timeline-panel wow fadeInRight" data-wow-delay=".9s">*/
/*                             <div class="timeline-heading">*/
/*                                 <h4 class="timeline-title">+100</h4>*/
/*                             </div>*/
/*                             <div class="timeline-body">*/
/*                                 <p>employees</p>*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/* */
/* */
/*                 </div>*/
/* */
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* </section>*/
/* */
/* <section id="contact">*/
/*     <div class="container">*/
/*         <div class="row">*/
/*             <div class="col-lg-8 col-lg-offset-2 text-center">*/
/*                 <h2 class="margin-top-0 text-primary wow fadeIn">Contact</h2>*/
/*                 <hr class="primary">*/
/*                 <p class="text-faded">We love feedback. Fill out the form below and we'll get back to you as soon as possible.</p>*/
/*             </div>*/
/*             <div class="col-lg-10 col-lg-offset-1 text-center">*/
/*                 <div class="container">*/
/*                     {% include '@App/Others/Default/contactSimpleForm.html.twig' with {'form': contactFrom} %}*/
/*                 </div>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* </section>*/
/* */
/* <footer id="footer">*/
/*     <div class="container-fluid">*/
/*         <div class="row">*/
/*             <!--<div class="col-xs-6 col-sm-3 column">*/
/*                 <h4>Information</h4>*/
/*                 <ul class="list-unstyled">*/
/*                     <li><a href="">Products</a></li>*/
/*                     <li><a href="">Services</a></li>*/
/*                     <li><a href="">Benefits</a></li>*/
/*                     <li><a href="">Developers</a></li>*/
/*                 </ul>*/
/*             </div>-->*/
/*             <div class="col-xs-12 content-nav-pills">*/
/*                 <ul class="nav nav-pills">*/
/*                     <li><a href="{{ path('privacy_policy') }}" target="_blank">Privacy Policy</a></li>*/
/*                     <li><a href="{{ path('terms_conditions') }}" target="_blank">Terms &amp; Conditions</a></li>*/
/*                     <li><a href="{{ path('legal_notice') }}" target="_blank">Legal Notice</a></li>*/
/*                 </ul>*/
/*             </div>*/
/*             <!--<div class="col-xs-12 col-sm-3 column">*/
/*                 <h4>Stay Posted</h4>*/
/*                 <form>*/
/*                     <div class="form-group">*/
/*                       <input type="text" class="form-control" title="No spam, we promise!" placeholder="Tell us your email">*/
/*                     </div>*/
/*                     <div class="form-group">*/
/*                       <button class="btn btn-primary" data-toggle="modal" data-target="#alertModal" type="button">Subscribe for updates</button>*/
/*                     </div>*/
/*                 </form>*/
/*             </div>-->*/
/*             <!--<div class="col-xs-12 col-sm-3 text-right">*/
/*                 <h4>Follow</h4>*/
/*                 <ul class="list-inline">*/
/*                   <li><a rel="nofollow" href="" title="Twitter"><i class="icon-lg ion-social-twitter-outline"></i></a>&nbsp;</li>*/
/*                   <li><a rel="nofollow" href="" title="Facebook"><i class="icon-lg ion-social-facebook-outline"></i></a>&nbsp;</li>*/
/*                   <li><a rel="nofollow" href="" title="Dribble"><i class="icon-lg ion-social-dribbble-outline"></i></a></li>*/
/*                 </ul>*/
/*             </div>-->*/
/*         </div>*/
/*         <span style="color: #c3c3c3;" class="col-xs-12 text-center small">Wolopay ©2015 All rights reserved</span>*/
/*     </div>*/
/* </footer>*/
/* <div id="galleryModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">*/
/*     <div class="modal-dialog modal-lg">*/
/*         <div class="modal-content">*/
/*             <div class="modal-body">*/
/*                 <img src="//placehold.it/1200x700/222?text=..." id="galleryImage" class="img-responsive" />*/
/*                 <p>*/
/*                     <br/>*/
/*                     <button class="btn btn-primary btn-lg center-block" data-dismiss="modal" aria-hidden="true">Close <i class="ion-android-close"></i></button>*/
/*                 </p>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* <div id="alert-modal-contact" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">*/
/*     <div class="modal-dialog modal-sm">*/
/*         <div class="modal-content">*/
/*             <div class="modal-body">*/
/*                 <p class="text-center">{{ 'email_was_sent_and_we_will_contact' | trans({}) | raw }}</p>*/
/*                 <br/>*/
/*                 <button class="btn btn-primary btn-lg center-block" data-dismiss="modal" aria-hidden="true">OK <i class="ion-android-close"></i></button>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* <!--scripts loaded here from cdn for performance -->*/
/* <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>*/
/* <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>*/
/* <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>*/
/* <script src="//cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.js"></script>*/
/* */
/* {% javascripts*/
/*     '@AppBundle/Resources/public/default/js/scripts.js'*/
/*     'plugin/lightbox.js'*/
/* %}*/
/*     <script type="text/javascript" src="{{ asset_url }}"></script>*/
/* {% endjavascripts %}*/
/* <!-- {{ "now"|date("d/m/Y H:i:s") }} -->*/
/* </body>*/
/* </html>*/
