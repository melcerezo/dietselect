@extends('layouts.app')
@section('head')

@endsection
@section('content')
<nav>
    <div class="nav-wrapper light-green">
        <a href="#" class="brand-logo">Diet Select</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li>
                <a href="{{route('about')}}">
                    <span style="margin-left: 2px;">About</span>
                </a>
            </li>
            <li>
                <a href="{{route('welcome')}}">
                    <span style="margin-left: 2px;">Back To Welcome Page</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <ul class="collection">
                        <li class="collection-item light-green white-text">
                            <span class="collection-header">Disclaimer</span>
                        </li>
                        <li class="collection-item">
                            <h4>1.	Introduction</h4>
                                <ul>
                                    <li>1.1	This disclaimer shall govern your use of our website.</li>
                                    <li>1.2	By using our website, you accept this disclaimer in full; accordingly, if you disagree with this disclaimer or any part of this disclaimer, you must not use our website.</li>
                                    <li>1.3	Our website uses cookies; by using our website or agreeing to this disclaimer, you consent to our use of cookies in accordance with the terms of our [privacy and cookies policy].</li>
                                </ul>
                        </li>
                        <li class="collection-item">
                            <h4>2.	Credit</h4>
                            <ul>
                                <li>2.1	This document was created using a template from SEQ Legal (http://www.seqlegal.com).</li>
                            </ul>
                        </li>
                        <li class="collection-item">
                            <h4>3.	Licence to use website</h4>
                            <p>3.1	You may:</p>
                            <ul>
                                <li>(a)	view pages from our website in a web browser;</li>
                                <li>(b)	download pages from our website for caching in a web browser; and</li>
                                <li>(c)	print pages from our website, subject to the other provisions of this disclaimer.</li>
                            </ul>
                            
                            <p>3.2	Except as expressly permitted by Section 4.1 or the other provisions of this disclaimer, you must not download any material from our website or save any such material to your computer.</p>
                            <p>3.3	You may only use our website for [your own personal and business purposes], and you must not use our website for any other purposes.</p>
                            <p>3.4	Unless you own or control the relevant rights in the material, you must not:</p>
                            <ul>
                                <li>(a)	republish material from our website (including republication on another website);</li>
                                <li>(b)	sell, rent or sub-license material from our website;</li>
                                <li>(c)	show any material from our website in public;</li>
                                <li>(d)	exploit material from our website for a commercial purpose; or</li>
                                <li>(e)	redistribute material from our website.</li>
                            </ul>
                            <p>3.5	We reserve the right to restrict access to areas of our website, or indeed our whole website, at our discretion; you must not circumvent or bypass, or attempt to circumvent or bypass, any access restriction measures on our website.</p>

                        </li>
                        <li class="collection-item">
                            <h4>4.	Acceptable use</h4>
                            <p>4.1	You must not:</p>
                            <ul>
                                <li>(a)	use our website in any way or take any action that causes, or may cause, damage to the website or impairment of the performance, availability or accessibility of the website;</li>
                                <li>(b)	use our website in any way that is unlawful, illegal, fraudulent or harmful, or in connection with any unlawful, illegal, fraudulent or harmful purpose or activity;</li>
                                <li>(c)	use our website to copy, store, host, transmit, send, use, publish or distribute any material which consists of (or is linked to) any spyware, computer virus, Trojan horse, worm, keystroke logger, rootkit or other malicious computer software;</li>
                                <li>(d)	[conduct any systematic or automated data collection activities (including without limitation scraping, data mining, data extraction and data harvesting) on or in relation to our website without our express written consent];</li>
                                <li>(e)	[access or otherwise interact with our website using any robot, spider or other automated means[, except for the purpose of [search engine indexing]]];</li>
                                <li>(f)	[violate the directives set out in the robots.txt file for our website]; or</li>
                                <li>(g)	[use data collected from our website for any direct marketing activity (including without limitation email marketing, SMS marketing, telemarketing and direct mailing)].</li>
                            </ul>
                            <p>4.2	You must not use data collected from our website to contact individuals, companies or other persons or entities.</p>
                            <p>4.3	You must ensure that all the information you supply to us through our website, or in relation to our website, is [true, accurate, current, complete and non-misleading].</p>

                        </li>
                        <li class="collection-item">
                            <h4>5.	Limited warranties</h4>
                            <p>5.1	We do not warrant or represent:</p>
                            <ul>
                                <li>(a)	the completeness or accuracy of the information published on our website;</li>
                                <li>(b)	that the material on the website is up to date; or</li>
                                <li>(c)	that the website or any service on the website will remain available.</li>
                            </ul>
                            <p>5.2	We reserve the right to discontinue or alter any or all of our website services, and to stop publishing our website, at any time in our sole discretion without notice or explanation; and save to the extent expressly provided otherwise in this disclaimer, you will not be entitled to any compensation or other payment upon the discontinuance or alteration of any website services, or if we stop publishing the website.</p>
                            <p>5.3	To the maximum extent permitted by applicable law and subject to Section 7.1, we exclude all representations and warranties relating to the subject matter of this disclaimer, our website and the use of our website.</p>

                        </li>
                        <li class="collection-item">
                            <h4>6.	Limitations and exclusions of liability</h4>
                            <p>6.1	Nothing in this disclaimer will:</p>
                            <ul>
                                <li>(a)	limit or exclude any liability for death or personal injury resulting from negligence;</li>
                                <li>(b)	limit or exclude any liability for fraud or fraudulent misrepresentation;</li>
                                <li>(c)	limit any liabilities in any way that is not permitted under applicable law; or</li>
                                <li>(d)	exclude any liabilities that may not be excluded under applicable law.</li>
                            </ul>
                        </li>
                        <li class="collection-item">
                            <h4>7.	Our details</h4>
                            <p>7.1	This website is owned and operated by DietSelect.</p>
                            <p>7.2	You can contact us:</p>
                            <ul>
                                <li>(a)	by email, using admin@dietselect.org.</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection