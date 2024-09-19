<x-app-layout>
    <div class="page-content window-height">
        @include('layouts.header', ['title' => 'Privacy Policy', 'description' => '', 'show_search' => false])
        <div class="privacy-policy-section common-padding-lr after-header-section">
            <ul class="list-style">
                <li>Your privacy is important to us. It is <span
                        class="fw-600">Dentcraft
                        NSW Pty Ltd's </span> policy to respect your privacy regarding
                    any
                    information we may collect from you across our web application, <a
                        href="{{ env('APP_URL') }}"
                        style="color:#69b446 !important">{{ env('APP_URL') }}</a>,
                    and
                    other sites we own and operate.</li>

                <li>We only ask for personal information when we truly need it to
                    provide a
                    service to you. We collect it by fair and lawful means, with your
                    knowledge and consent. We also let you know why we’re collecting it
                    and
                    how it will be used.</li>

                <li>We only retain collected information for as long as necessary to
                    provide you with your requested service. What data we store, we’ll
                    protect within commercially acceptable means to prevent loss and
                    theft,
                    as well as unauthorised access, disclosure, copying, use or
                    modification.</li>

                <li>We don’t share any personally identifying information publicly or
                    with
                    third-parties, except when required to by law.</li>

                <li>Our web application may link to external sites that are not operated
                    by
                    us. Please be aware that we have no control over the content and
                    practices of these sites, and cannot accept responsibility or
                    liability
                    for their respective privacy policies.</li>

                <li>You are free to refuse our request for your personal information,
                    with
                    the understanding that we may be unable to provide you with some of
                    your desired services.</li>

                <li>Your continued use of our web application will be regarded as
                    acceptance of our practices around privacy and personal information.
                    If
                    you have any questions about how we handle user data and personal
                    information, feel free to contact us.</li>

                <li>This policy is effective as of <span class="fw-600">21 February
                        2020</span>.</li>
            </ul>
        </div>
        @include('layouts.footer')
    </div>
</x-app-layout>
