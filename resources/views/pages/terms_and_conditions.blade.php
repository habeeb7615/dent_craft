<x-app-layout>
    <div class="page-content window-height">
        @include('layouts.header', ['title' => 'Terms And Conditions', 'description' => '', 'show_search' => false])
        <div class="terms-and-conditions-section common-padding-lr after-header-section">
            <h3>Dentcraft NSW Pty Ltd Terms of Service</h3>
            <ul>
                <h4>1. Terms</h4>
                <li>By accessing the web application at <a href="{{ env('APP_URL') }}"
                        style="color:#69b446 !important">{{ env('APP_URL') }}</a>,
                    you are agreeing to be bound by these terms of service,
                    all applicable laws and regulations, and agree that you are
                    responsible for compliance with any applicable local laws. If you do
                    not agree with any of these terms, you are prohibited from using or
                    accessing this site.
                    The materials contained in this web application are protected by
                    applicable copyright and trademark law.
                    Dentcraft NSW Pty Ltd uses third-party services including Google Place Autocomplete service. Users of the application are bound by Google’s <a href="https://policies.google.com/terms?hl=en"
                       style="color:#69b446 !important" >Terms of Service</a>, <a href=" https://cloud.google.com/maps-platform/terms/"
                       style="color:#69b446 !important" >Terms of Use</a> and <a href="https://policies.google.com/privacy"
                       style="color:#69b446 !important" >Privacy Policy.</a>.
                    </li>
                <h4>2. Use Licence</h4>
                <li>1. Permission is granted to temporarily
                    download one copy of the materials (information or software) on
                    <span class="fw-600">Dentcraft NSW Pty Ltd's</span> web application
                    for personal, non-commercial transitory viewing only.
                    This is the grant of a licence, not a transfer of title, and under
                    this licence, you may not:
                </li>
                <ul>
                    <li>1. modify or copy the materials;</li>
                    <li>2. Use the materials for any commercial
                        purpose, or for any public display (commercial or
                        non-commercial);</li>
                    <li>3. attempt to decompile or reverse
                        engineer any software contained on <span class="fw-600">Dentcraft NSW Pty Ltd's</span>
                        web
                        application;</li>
                    <li>4. remove any copyright or other
                        proprietary notations from the materials; or</li>
                    <li>5. transfer the materials to another
                        person or "mirror" the materials on any other server.</li>
                </ul>
                <li>2.This licence shall automatically terminate
                    if you violate any of these restrictions and may be terminated
                    by<span class="fw-600">Dentcraft NSW Pty Ltd</span> at any time.
                    Upon terminating your viewing of these materials or upon the
                    termination of this licence,
                    you must destroy any downloaded materials in your possession whether
                    in electronic or printed format.</li>
                <h4>3. Disclaimer</h4>

                <li>1.The materials on <span class="fw-600">Dentcraft NSW Pty
                        Ltd's</span> web application
                    are provided on an 'as is' basis.
                    <span class="fw-600">Dentcraft NSW Pty Ltd</span> makes no
                    warranties, expressed or implied, and hereby disclaims and negates
                    all other warranties including, without limitation, implied
                    warranties or conditions of merchantability,
                    fitness for a particular purpose, or non-infringement of
                    intellectual property or other violation of rights.
                </li>

                <li>2. Further, <span class="fw-600">Dentcraft
                        NSW Pty Ltd</span> does not warrant or make any representations
                    concerning the accuracy, likely results,
                    or reliability of the use of the materials on its web application or
                    otherwise relating to such materials or on any sites linked to this
                    site.</li>

                <h4>4. Limitations</h4>
                <li>In no event shall <span class="fw-600">Dentcraft NSW Pty Ltd</span>
                    or its suppliers be
                    liable for any damages
                    (including, without limitation, damages for loss of data or profit,
                    or due to business interruption)
                    arising out of the use or inability to use the materials on <span class="fw-600">Dentcraft
                        NSW Pty Ltd's</span> web application,
                    even if <span class="fw-600">Dentcraft NSW Pty Ltd</span> or a <span
                        class="fw-600">Dentcraft NSW Pty Ltd</span> authorised
                    representative has been notified orally
                    or in writing of the possibility of such damage. Because some
                    jurisdictions do not allow limitations on implied warranties,
                    or limitations of liability for consequential or incidental damages,
                    these limitations may not apply to you.</li>

                <h4>5. Accuracy of materials</h4>
                <li>The materials appearing on<span class="fw-600">Dentcraft NSW Pty
                        Ltd's</span> web application
                    could include technical,
                    typographical, or photographic errors. <span class="fw-600">Dentcraft NSW Pty Ltd's</span>
                    does not warrant
                    that any of the materials
                    on its web application are accurate, complete or current. <span class="fw-600">Dentcraft NSW
                        Pty Ltd</span> may make changes to
                    the
                    materials contained on its web application at any time without
                    notice. However, <span class="fw-600">Dentcraft NSW Pty Ltd</span>
                    does
                    not make any commitment to update the materials.</li>

                <h4>6. Links</h4>
                <li><span class="fw-600">Dentcraft NSW Pty
                        Ltd</span> has not reviewed all of the sites linked to its web
                    application and is not responsible
                    for the contents of any such linked site. The inclusion of any link
                    does not imply endorsement by <span class="fw-600">Dentcraft NSW Pty
                        Ltd</span> of the site.
                    Use of any such linked web application is at the user's own risk.
                </li>

                <h4>7. Modifications</h4>
                <li><span>Dentcraft NSW Pty
                        Ltd</span> may revise these terms of service for its web
                    application at any
                    time without notice. By using this web application you are agreeing
                    to be bound by
                    the then current version of these terms of service.</li>

                <h4>8. Governing Law</h4>

                <li>These terms and conditions are governed by
                    and construed in accordance with the laws of New South Wales,
                    Australia and you irrevocably submit to the exclusive jurisdiction
                    of the courts in that State or location.</li>

            </ul>
        </div>
        @include('layouts.footer')
    </div>
</x-app-layout>
