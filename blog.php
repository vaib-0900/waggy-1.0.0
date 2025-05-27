<?php
include 'header.php';
?>
<section id="intro" class="py-5 bg-light">
  <div class="container text-center">
    <h1 class="display-4 fw-bold">Welcome to Our Blog</h1>
    <p class="lead">Discover the latest news, tips, and stories about pets and animals. Stay informed and inspired!</p>
    <a href="#latest-blog" class="btn btn-primary btn-lg text-uppercase mt-3">Explore Now</a>
  </div>

  <section id="latest-blog" class="my-5">
    <div class="container py-5 my-5">
      <div class="row mt-5">
        <div class="section-header d-md-flex justify-content-between align-items-center mb-3">
          <h2 class="display-3 fw-normal">Latest Blog Post</h2>
          <div>
            <a href="#" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">
              Read all
              <svg width="24" height="24" viewBox="0 0 24 24" class="mb-1">
                <use xlink:href="#arrow-right"></use>
              </svg></a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 my-4 my-md-0">
          <div class="z-1 position-absolute rounded-3 m-2 px-3 pt-1 bg-light">
            <h3 class="secondary-font text-primary m-0">20</h3>
            <p class="secondary-font fs-6 m-0">Feb</p>
            
          </div>
          <div class="card position-relative">
            <a href="single-post.html"><img src="images/blog1.jpg" class="img-fluid rounded-4" alt="image"></a>
            <div class="card-body p-0">
              <a href="single-post.html">
                <h3 class="card-title pt-4 pb-3 m-0">10 Reasons to be helpful towards any animals</h3>
              </a>
              
              <div class="card-text">
                <p class="blog-paragraph fs-6">At the core of our practice is the idea that cities are the incubators of
                  our greatest
                  achievements, and the best hope for a sustainable future.</p>
                  <a href="single-post.html" class="blog-read">read more</a>
                </div>
                
              </div>
            </div>
          </div>
          <div class="col-md-4 my-4 my-md-0">
            <div class="z-1 position-absolute rounded-3 m-2 px-3 pt-1 bg-light">
              <h3 class="secondary-font text-primary m-0">21</h3>
              <p class="secondary-font fs-6 m-0">Feb</p>
              
            </div>
            <div class="card position-relative">
              <a href="single-post.html"><img src="images/blog2.jpg" class="img-fluid rounded-4" alt="image"></a>
              <div class="card-body p-0">
                <a href="single-post.html">
                  <h3 class="card-title pt-4 pb-3 m-0">How to know your pet is hungry</h3>
                </a>
                
                <div class="card-text">
                  <p class="blog-paragraph fs-6">At the core of our practice is the idea that cities are the incubators of
                    our greatest
                    achievements, and the best hope for a sustainable future.</p>
                    <a href="single-post.html" class="blog-read">read more</a>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-md-4 my-4 my-md-0">
              <div class="z-1 position-absolute rounded-3 m-2 px-3 pt-1 bg-light">
                <h3 class="secondary-font text-primary m-0">22</h3>
                <p class="secondary-font fs-6 m-0">Feb</p>
                
              </div>
              <div class="card position-relative">
                <a href="single-post.html"><img src="images/blog3.jpg" class="img-fluid rounded-4" alt="image"></a>
                <div class="card-body p-0">
                  <a href="single-post.html">
                    <h3 class="card-title pt-4 pb-3 m-0">Best home for your pets</h3>
                  </a>
                  
                  <div class="card-text">
                    <p class="blog-paragraph fs-6">At the core of our practice is the idea that cities are the incubators of
                      our greatest
                      achievements, and the best hope for a sustainable future.</p>
                      <a href="single-post.html" class="blog-read">read more</a>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
            <section id="testimonial">
                <div class="container my-5 py-5">
                  <div class="row">
                    <div class="offset-md-1 col-md-10">
                      <div class="swiper testimonial-swiper">
                        <div class="swiper-wrapper">
            
                          <div class="swiper-slide">
                            <div class="row ">
                              <div class="col-2">
                                <iconify-icon icon="ri:double-quotes-l" class="quote-icon text-primary"></iconify-icon>
                              </div>
                            <div class="col-md-10 mt-md-5 p-5 pt-0 pt-md-5">
                              <p class="testimonial-content fs-2">Pets bring joy and companionship to our lives, making every day brighter and more fulfilling.</p>
                              <p class="text-black">- Alex Johnson</p>
                            </div>
                            </div>
                          </div>
                          <div class="swiper-slide">
                            <div class="row ">
                              <div class="col-2">
                                <iconify-icon icon="ri:double-quotes-l" class="quote-icon text-primary"></iconify-icon>
                              </div>
                        <div class="col-md-10 mt-md-5 p-5 pt-0 pt-md-5">
                          <p class="testimonial-content fs-2">Animals teach us unconditional love and remind us of the beauty in simplicity.</p>
                          <p class="text-black">- Emily Carter</p>
                        </div>
                            </div>
                          </div>
                          <div class="swiper-slide">
                            <div class="row ">
                              <div class="col-2">
                                <iconify-icon icon="ri:double-quotes-l" class="quote-icon text-primary"></iconify-icon>
                              </div>
                        <div class="col-md-10 mt-md-5 p-5 pt-0 pt-md-5">
                          <p class="testimonial-content fs-2">Pets are family, and they deserve the best care, love, and attention we can give them.</p>
                          <p class="text-black">- Sarah Thompson</p>
                          </div>                         
                            </div>
                          </div>
            
                        </div>
            
                        <div class="swiper-pagination"></div>
            
                      </div>
                    </div>
                  </div>
                </div>
            
              </section>
          </div>
        </section>
        </section>

  <?php
  include 'footer.php';
  ?>