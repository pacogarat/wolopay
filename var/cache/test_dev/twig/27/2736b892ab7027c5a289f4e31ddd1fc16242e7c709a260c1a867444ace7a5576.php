<?php

/* AppBundle:Others/Default/FAQ:faq_vi.html.twig */
class __TwigTemplate_1ef7bd17d41639b9d3f52ad1731ac934e44c77da1305da198d9f140b5bd22a77 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@App/Others/Default/FAQ/faq_layout.html.twig", "AppBundle:Others/Default/FAQ:faq_vi.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'faq_txt' => array($this, 'block_faq_txt'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@App/Others/Default/FAQ/faq_layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_425ff5f42e2af03e70496b32a0858ad414c4a0a9e707af7bc64e914158ae3b91 = $this->env->getExtension("native_profiler");
        $__internal_425ff5f42e2af03e70496b32a0858ad414c4a0a9e707af7bc64e914158ae3b91->enter($__internal_425ff5f42e2af03e70496b32a0858ad414c4a0a9e707af7bc64e914158ae3b91_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Others/Default/FAQ:faq_vi.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_425ff5f42e2af03e70496b32a0858ad414c4a0a9e707af7bc64e914158ae3b91->leave($__internal_425ff5f42e2af03e70496b32a0858ad414c4a0a9e707af7bc64e914158ae3b91_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_ebc152315711040c1aebfd444292a2e444465679e546e348daefd9aa1b86ae6b = $this->env->getExtension("native_profiler");
        $__internal_ebc152315711040c1aebfd444292a2e444465679e546e348daefd9aa1b86ae6b->enter($__internal_ebc152315711040c1aebfd444292a2e444465679e546e348daefd9aa1b86ae6b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "FAQ - Câu Hỏi Thường Gặp";
        
        $__internal_ebc152315711040c1aebfd444292a2e444465679e546e348daefd9aa1b86ae6b->leave($__internal_ebc152315711040c1aebfd444292a2e444465679e546e348daefd9aa1b86ae6b_prof);

    }

    // line 3
    public function block_faq_txt($context, array $blocks = array())
    {
        $__internal_8419730d926de50d6d957774584c8c9de2b89766d58ad08b914dcea22035d892 = $this->env->getExtension("native_profiler");
        $__internal_8419730d926de50d6d957774584c8c9de2b89766d58ad08b914dcea22035d892->enter($__internal_8419730d926de50d6d957774584c8c9de2b89766d58ad08b914dcea22035d892_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "faq_txt"));

        // line 4
        echo "
    <h2 class=\"text-center\">FAQ, Câu Hỏi Thường Gặp</h2>
    <h3 class=\"voffset4\">Tôi đã gửi tin nhắn SMS nhưng chưa nhận được câu trả lời</h3>
    <p class=\"voffset3\">
        Có một số lý do cho sự việc này:
    <ul>
        <li> Bạn đã viết nhầm văn bản, hoặc đã gửi đến nhầm số điện thoại; vui lòng kiểm tra lại và nếu đúng như vậy, vui lòng gửi lại cho chúng tôi.</li>
        <li> Bạn không có đủ số tiền trong tài khoản trả trước của mình.</li>
        <li> Số điện thoại của bạn đã bị \"liệt vào danh sách đen\" trong hệ thống của chúng tôi, có thể do chủ hợp đồng yêu cầu như vậy hoặc do chúng tôi được cảnh báo về việc hóa đơn trước đó của bạn chưa được thanh toán. </li>
        <li> Bạn không thể truy cập vào dịch vụ SMS premium từ đường line của bạn do loại dịch vụ này đã không được kích hoạt theo mặc định. Bạn nên liên hệ với nhà mạng để kích hoạt nó.</li>
        <li> Nhà mạng đã khóa dịch vụ SMS premium trong đường line của bạn do chủ hợp đồng yêu cầu như thế. </li>
        <li> Dịch vụ SMS Premium hiện không có sẵn trên nhà mạng của bạn (nhiều nhà mạng ảo không cho phép sử dụng dịch vụ này)</li>
        <li> Một số nhà mạng không cho phép sử dụng dịch vụ SMS Premium trong \"hợp đồng công ty\", hoặc việc truy cập sẽ được gửi đến số có số 0 ở đầu, chẳng hạn như gửi đến số 025522. </li>
    </ul>
    </p>

    <p> Nếu bạn cho rằng trường hợp của mình không thuộc bất kỳ trường hợp nào nêu trên, vui lòng ghé qua trung tâm trợ giúp của chúng tôi, điền vào mẫu đơn, bao gồm số điện thoại di động bạn vừa gửi tin đến. Chúng tôi sẽ kiểm tra và liên lạc lại với bạn để giải đáp vấn đề.
    </p>

    <h3>Tôi không thể gọi đến số điện thoại được cung cấp trong phần hướng dẫn. </h3>
    <p>
        Liên quan đến tin nhắn SMS, sự cố có thể xảy ra vì các lý do sau:
    <ul>
        <li> Bạn đã viết nhầm văn bản, hoặc đã gửi đến nhầm số điện thoại; vui lòng kiểm tra và thử lại.</li>
        <li> Bạn không có đủ số tiền trong tài khoản trả trước của mình.</li>
        <li> Số điện thoại của bạn đã bị \"liệt vào danh sách đen\" trong hệ thống của chúng tôi, có thể do chủ hợp đồng yêu cầu như vậy hoặc do chúng tôi được cảnh báo về việc hóa đơn trước đó của bạn chưa được thanh toán.</li>
        <li> Bạn không thể truy cập vào dịch vụ SMS premium từ đường line của bạn do loại dịch vụ này đã không được kích hoạt theo mặc định. Bạn nên liên hệ với nhà mạng để kích hoạt nó.</li>
        <li> Nhiều công ty ngăn chặn truy cập vào dịch vụ premium của nhân viên của họ đối với điện thoại bàn lẫn điện thoại di động. </li>
        <li> Nhà mạng đã khóa dịch vụ SMS premium trong đường line của bạn do chủ hợp đồng yêu cầu như thế. </li>
        <li> Dịch vụ SMS Premium hiện không có sẵn trên nhà mạng của bạn (nhiều nhà mạng ảo không cho phép sử dụng dịch vụ này)</li>
        <li> Một số nhà mạng không cho phép sử dụng dịch vụ SMS Premium trong \"hợp đồng công ty\", nếu đúng như vậy, chủ hợp đồng sẽ là người yêu cầu kích hoạt.</li>
    </ul>
    </p>
    <p>
        Nếu bạn cho rằng trường hợp của mình không thuộc bất kỳ trường hợp nào nêu trên, vui lòng ghé qua trung tâm trợ giúp của chúng tôi, điền vào mẫu đơn bao gồm số điện thoại di động bạn vừa gửi tin đến. Chúng tôi sẽ kiểm tra và liên lạc lại với bạn để giải đáp vấn đề.
    </p>
    <h3>Tôi đã chi trả bằng payPal, nhưng tín dụng không hiển thị trong tài khoản của tôi.</h3>
    <p>
        Chúng tôi cần bạn gửi đến địa chỉ support@wolopay.net mã số giao dịch, gồm mã số giao dịch trên wolopay lẫn trên Paypal, cùng với chứng cứ việc bạn đã chi trả bằng Paypal. Sau khi kiểm tra thông tin, chúng tôi sẽ liên lạc với trò chơi, thông báo về vấn đề này để họ tiến hành giao dịch.
    </p>

    <h3>Tôi đã gửi tin nhắn SMS (hoặc gọi điện thoại), và đã có mã số. Vậy tôi phải làm gì với nó? </h3>
    <p>
        Nếu bạn đã nhấn phím gửi tin nhắn SMS, hoặc gọi đến số điện thoại của trò chơi mà không bắt đầu thực hiện giao dịch trong game, chúng tôi không thể chuyển tin nhắn (hoặc cuộc gọi) của bạn thành một giao dịch, và do vậy, chúng tôi không thể thông báo đến trò chơi để họ bổ sung tín dụng của bạn. Bạn phải truy cập vào trò chơi, đến khu vực tín dụng, chọn phương thức thanh toán và trong hướng dẫn đừng gửi một tin nhắn SMS mới hay thực hiện cuộc gọi mới. Nhấp vào tiếp tục và ở bước thứ hai, bạn sẽ phải nhập mã số (chỉ được nhập 1 lần!).
    </p>

    <h3>Tôi đã có mã số, và khi nhập vào, tôi được thông báo rằng mã số này đã được sử dụng rồi</h3>
    <p>
        Ghé qua trung tâm trợ giúp của chúng tôi, nhập thông tin theo yêu cầu, bao gồm mã số và địa chỉ email của bạn, chúng tôi sẽ kiểm tra xem mã số này đã được sử dụng hay chưa (nếu có, ở đâu và khi nào), trong trường hợp chưa được sử dụng, chúng tôi sẽ thông báo giải pháp cho bạn bằng email (gửi mã số mới).
    </p>


";
        
        $__internal_8419730d926de50d6d957774584c8c9de2b89766d58ad08b914dcea22035d892->leave($__internal_8419730d926de50d6d957774584c8c9de2b89766d58ad08b914dcea22035d892_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Others/Default/FAQ:faq_vi.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 4,  47 => 3,  35 => 2,  11 => 1,);
    }
}
/* {% extends "@App/Others/Default/FAQ/faq_layout.html.twig" %}*/
/* {% block title %}FAQ - Câu Hỏi Thường Gặp{% endblock %}*/
/* {% block faq_txt %}*/
/* */
/*     <h2 class="text-center">FAQ, Câu Hỏi Thường Gặp</h2>*/
/*     <h3 class="voffset4">Tôi đã gửi tin nhắn SMS nhưng chưa nhận được câu trả lời</h3>*/
/*     <p class="voffset3">*/
/*         Có một số lý do cho sự việc này:*/
/*     <ul>*/
/*         <li> Bạn đã viết nhầm văn bản, hoặc đã gửi đến nhầm số điện thoại; vui lòng kiểm tra lại và nếu đúng như vậy, vui lòng gửi lại cho chúng tôi.</li>*/
/*         <li> Bạn không có đủ số tiền trong tài khoản trả trước của mình.</li>*/
/*         <li> Số điện thoại của bạn đã bị "liệt vào danh sách đen" trong hệ thống của chúng tôi, có thể do chủ hợp đồng yêu cầu như vậy hoặc do chúng tôi được cảnh báo về việc hóa đơn trước đó của bạn chưa được thanh toán. </li>*/
/*         <li> Bạn không thể truy cập vào dịch vụ SMS premium từ đường line của bạn do loại dịch vụ này đã không được kích hoạt theo mặc định. Bạn nên liên hệ với nhà mạng để kích hoạt nó.</li>*/
/*         <li> Nhà mạng đã khóa dịch vụ SMS premium trong đường line của bạn do chủ hợp đồng yêu cầu như thế. </li>*/
/*         <li> Dịch vụ SMS Premium hiện không có sẵn trên nhà mạng của bạn (nhiều nhà mạng ảo không cho phép sử dụng dịch vụ này)</li>*/
/*         <li> Một số nhà mạng không cho phép sử dụng dịch vụ SMS Premium trong "hợp đồng công ty", hoặc việc truy cập sẽ được gửi đến số có số 0 ở đầu, chẳng hạn như gửi đến số 025522. </li>*/
/*     </ul>*/
/*     </p>*/
/* */
/*     <p> Nếu bạn cho rằng trường hợp của mình không thuộc bất kỳ trường hợp nào nêu trên, vui lòng ghé qua trung tâm trợ giúp của chúng tôi, điền vào mẫu đơn, bao gồm số điện thoại di động bạn vừa gửi tin đến. Chúng tôi sẽ kiểm tra và liên lạc lại với bạn để giải đáp vấn đề.*/
/*     </p>*/
/* */
/*     <h3>Tôi không thể gọi đến số điện thoại được cung cấp trong phần hướng dẫn. </h3>*/
/*     <p>*/
/*         Liên quan đến tin nhắn SMS, sự cố có thể xảy ra vì các lý do sau:*/
/*     <ul>*/
/*         <li> Bạn đã viết nhầm văn bản, hoặc đã gửi đến nhầm số điện thoại; vui lòng kiểm tra và thử lại.</li>*/
/*         <li> Bạn không có đủ số tiền trong tài khoản trả trước của mình.</li>*/
/*         <li> Số điện thoại của bạn đã bị "liệt vào danh sách đen" trong hệ thống của chúng tôi, có thể do chủ hợp đồng yêu cầu như vậy hoặc do chúng tôi được cảnh báo về việc hóa đơn trước đó của bạn chưa được thanh toán.</li>*/
/*         <li> Bạn không thể truy cập vào dịch vụ SMS premium từ đường line của bạn do loại dịch vụ này đã không được kích hoạt theo mặc định. Bạn nên liên hệ với nhà mạng để kích hoạt nó.</li>*/
/*         <li> Nhiều công ty ngăn chặn truy cập vào dịch vụ premium của nhân viên của họ đối với điện thoại bàn lẫn điện thoại di động. </li>*/
/*         <li> Nhà mạng đã khóa dịch vụ SMS premium trong đường line của bạn do chủ hợp đồng yêu cầu như thế. </li>*/
/*         <li> Dịch vụ SMS Premium hiện không có sẵn trên nhà mạng của bạn (nhiều nhà mạng ảo không cho phép sử dụng dịch vụ này)</li>*/
/*         <li> Một số nhà mạng không cho phép sử dụng dịch vụ SMS Premium trong "hợp đồng công ty", nếu đúng như vậy, chủ hợp đồng sẽ là người yêu cầu kích hoạt.</li>*/
/*     </ul>*/
/*     </p>*/
/*     <p>*/
/*         Nếu bạn cho rằng trường hợp của mình không thuộc bất kỳ trường hợp nào nêu trên, vui lòng ghé qua trung tâm trợ giúp của chúng tôi, điền vào mẫu đơn bao gồm số điện thoại di động bạn vừa gửi tin đến. Chúng tôi sẽ kiểm tra và liên lạc lại với bạn để giải đáp vấn đề.*/
/*     </p>*/
/*     <h3>Tôi đã chi trả bằng payPal, nhưng tín dụng không hiển thị trong tài khoản của tôi.</h3>*/
/*     <p>*/
/*         Chúng tôi cần bạn gửi đến địa chỉ support@wolopay.net mã số giao dịch, gồm mã số giao dịch trên wolopay lẫn trên Paypal, cùng với chứng cứ việc bạn đã chi trả bằng Paypal. Sau khi kiểm tra thông tin, chúng tôi sẽ liên lạc với trò chơi, thông báo về vấn đề này để họ tiến hành giao dịch.*/
/*     </p>*/
/* */
/*     <h3>Tôi đã gửi tin nhắn SMS (hoặc gọi điện thoại), và đã có mã số. Vậy tôi phải làm gì với nó? </h3>*/
/*     <p>*/
/*         Nếu bạn đã nhấn phím gửi tin nhắn SMS, hoặc gọi đến số điện thoại của trò chơi mà không bắt đầu thực hiện giao dịch trong game, chúng tôi không thể chuyển tin nhắn (hoặc cuộc gọi) của bạn thành một giao dịch, và do vậy, chúng tôi không thể thông báo đến trò chơi để họ bổ sung tín dụng của bạn. Bạn phải truy cập vào trò chơi, đến khu vực tín dụng, chọn phương thức thanh toán và trong hướng dẫn đừng gửi một tin nhắn SMS mới hay thực hiện cuộc gọi mới. Nhấp vào tiếp tục và ở bước thứ hai, bạn sẽ phải nhập mã số (chỉ được nhập 1 lần!).*/
/*     </p>*/
/* */
/*     <h3>Tôi đã có mã số, và khi nhập vào, tôi được thông báo rằng mã số này đã được sử dụng rồi</h3>*/
/*     <p>*/
/*         Ghé qua trung tâm trợ giúp của chúng tôi, nhập thông tin theo yêu cầu, bao gồm mã số và địa chỉ email của bạn, chúng tôi sẽ kiểm tra xem mã số này đã được sử dụng hay chưa (nếu có, ở đâu và khi nào), trong trường hợp chưa được sử dụng, chúng tôi sẽ thông báo giải pháp cho bạn bằng email (gửi mã số mới).*/
/*     </p>*/
/* */
/* */
/* {% endblock %}*/
