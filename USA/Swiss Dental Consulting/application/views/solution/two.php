
        <?php
            echo funGetAdvancedBanners($solutionTag.'two', '
                <div class="section back-white overflow-hid bg-patter-contact-4 white-bg" style="z-index:2;">
                    
                    <div class="section">
                        <div class="container">
                            <div class="twelve columns"  data-scroll-reveal="enter bottom move 100px over 0.6s after 0.2s" style="transform: translateY(150px);">
                                <div class="process">
                                    <h3 style="font-weight: 500;color: #091f40; font-size: 33px">{{title}}</h3>
                                    <p style="font-size: 18px;max-width: 775px;line-height: 28px;font-weight: 400;margin-top: 20px">{{text}}</p>
                                    <p style="font-size: 18px;max-width: 775px;line-height: 28px;font-weight: 400;margin-top: 40px">{{subtext}}</p>
                                </div>
                            </div>
                            <div class="twelve columns remove-bottom"  >
                                <div class="img-top-2" data-scroll-reveal="enter bottom move 100px over 1s after 0.3s">
                                    <img class="tipped" src="{{img}}" alt="Some image"/>
                                </div>
                            </div>							
                        </div>	
                    </div>
                    
                </div>');
        ?>