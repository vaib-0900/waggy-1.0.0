<?php
include "header.php";
?>

<section id="all-services" class="py-5 bg-light">
  <div class="container">
    <div class="text-center mb-5">
      <h1 class="fw-bold display-4 mb-3">Our Complete Service Portfolio</h1>
      <p class="lead text-muted mx-auto" style="max-width: 800px;">
        Discover the full range of premium services designed to transform your shopping experience.
      </p>
    </div>

    <!-- Service Categories Navigation -->
    <div class="row justify-content-center mb-5">
      <div class="col-lg-10">
        <ul class="nav nav-pills justify-content-center flex-wrap" id="serviceTabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="delivery-tab" data-bs-toggle="pill" data-bs-target="#delivery" type="button" role="tab">Delivery Services</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="support-tab" data-bs-toggle="pill" data-bs-target="#support" type="button" role="tab">Customer Support</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="shopping-tab" data-bs-toggle="pill" data-bs-target="#shopping" type="button" role="tab">Shopping Services</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="security-tab" data-bs-toggle="pill" data-bs-target="#security" type="button" role="tab">Security & Returns</button>
          </li>
        </ul>
      </div>
    </div>

    <!-- Tab Content -->
    <div class="tab-content" id="serviceTabsContent">
      <!-- Delivery Services Tab -->
      <div class="tab-pane fade show active" id="delivery" role="tabpanel">
        <div class="row g-4">
          <div class="col-lg-4 col-md-6">
            <div class="card h-100 border-0 shadow-sm">
              <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                  <div class="icon-wrapper bg-primary bg-opacity-10 rounded-circle me-3" style="width: 60px; height: 60px;">
                    <iconify-icon icon="mdi:truck-fast-outline" class="text-primary" style="font-size: 1.8rem;"></iconify-icon>
                  </div>
                  <h4 class="mb-0">Lightning Delivery</h4>
                </div>
                <p class="text-muted">Get your orders delivered within 2 hours in select cities. Real-time tracking with GPS updates.</p>
                <ul class="list-unstyled text-muted">
                  <li class="mb-1"><iconify-icon icon="mdi:check-circle" class="text-success me-2"></iconify-icon> Available in 15 major cities</li>
                  <li class="mb-1"><iconify-icon icon="mdi:check-circle" class="text-success me-2"></iconify-icon> Contactless delivery option</li>
                  <li><iconify-icon icon="mdi:check-circle" class="text-success me-2"></iconify-icon> Delivery window selection</li>
                </ul>
                <div class="d-flex justify-content-between align-items-center mt-3">
                  <span class="badge bg-primary bg-opacity-10 text-primary">Most Popular</span>
                  <a href="#" class="btn btn-sm btn-outline-primary">Details</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="card h-100 border-0 shadow-sm">
              <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                  <div class="icon-wrapper bg-primary bg-opacity-10 rounded-circle me-3" style="width: 60px; height: 60px;">
                    <iconify-icon icon="mdi:calendar-clock" class="text-primary" style="font-size: 1.8rem;"></iconify-icon>
                  </div>
                  <h4 class="mb-0">Scheduled Delivery</h4>
                </div>
                <p class="text-muted">Choose your preferred delivery date and time slot that works best for you.</p>
                <ul class="list-unstyled text-muted">
                  <li class="mb-1"><iconify-icon icon="mdi:check-circle" class="text-success me-2"></iconify-icon> Available 7 days a week</li>
                  <li class="mb-1"><iconify-icon icon="mdi:check-circle" class="text-success me-2"></iconify-icon> 2-hour delivery windows</li>
                  <li><iconify-icon icon="mdi:check-circle" class="text-success me-2"></iconify-icon> Evening and weekend slots</li>
                </ul>
                <div class="d-flex justify-content-between align-items-center mt-3">
                  <a href="#" class="btn btn-sm btn-outline-primary">Details</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="card h-100 border-0 shadow-sm">
              <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                  <div class="icon-wrapper bg-primary bg-opacity-10 rounded-circle me-3" style="width: 60px; height: 60px;">
                    <iconify-icon icon="mdi:package-variant" class="text-primary" style="font-size: 1.8rem;"></iconify-icon>
                  </div>
                  <h4 class="mb-0">International Shipping</h4>
                </div>
                <p class="text-muted">Global delivery to over 50 countries with customs clearance assistance.</p>
                <ul class="list-unstyled text-muted">
                  <li class="mb-1"><iconify-icon icon="mdi:check-circle" class="text-success me-2"></iconify-icon> Door-to-door tracking</li>
                  <li class="mb-1"><iconify-icon icon="mdi:check-circle" class="text-success me-2"></iconify-icon> Duties & taxes calculator</li>
                  <li><iconify-icon icon="mdi:check-circle" class="text-success me-2"></iconify-icon> Express options available</li>
                </ul>
                <div class="d-flex justify-content-between align-items-center mt-3">
                  <span class="badge bg-warning bg-opacity-10 text-warning">Global</span>
                  <a href="#" class="btn btn-sm btn-outline-primary">Details</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Customer Support Tab -->
      <div class="tab-pane fade" id="support" role="tabpanel">
        <div class="row g-4">
          <div class="col-lg-4 col-md-6">
            <div class="card h-100 border-0 shadow-sm">
              <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                  <div class="icon-wrapper bg-primary bg-opacity-10 rounded-circle me-3" style="width: 60px; height: 60px;">
                    <iconify-icon icon="mdi:headset" class="text-primary" style="font-size: 1.8rem;"></iconify-icon>
                  </div>
                  <h4 class="mb-0">24/7 Support</h4>
                </div>
                <p class="text-muted">Round-the-clock assistance via phone, chat, or email with our expert team.</p>
                <ul class="list-unstyled text-muted">
                  <li class="mb-1"><iconify-icon icon="mdi:check-circle" class="text-success me-2"></iconify-icon> Average response time <2 min</li>
                  <li class="mb-1"><iconify-icon icon="mdi:check-circle" class="text-success me-2"></iconify-icon> Multilingual support</li>
                  <li><iconify-icon icon="mdi:check-circle" class="text-success me-2"></iconify-icon> Technical specialists available</li>
                </ul>
                <div class="d-flex justify-content-between align-items-center mt-3">
                  <span class="badge bg-primary bg-opacity-10 text-primary">Instant Help</span>
                  <a href="#" class="btn btn-sm btn-outline-primary">Details</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="card h-100 border-0 shadow-sm">
              <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                  <div class="icon-wrapper bg-primary bg-opacity-10 rounded-circle me-3" style="width: 60px; height: 60px;">
                    <iconify-icon icon="mdi:chat-question" class="text-primary" style="font-size: 1.8rem;"></iconify-icon>
                  </div>
                  <h4 class="mb-0">Shopping Assistance</h4>
                </div>
                <p class="text-muted">Get personalized recommendations and advice from our product experts.</p>
                <ul class="list-unstyled text-muted">
                  <li class="mb-1"><iconify-icon icon="mdi:check-circle" class="text-success me-2"></iconify-icon> One-on-one consultations</li>
                  <li class="mb-1"><iconify-icon icon="mdi:check-circle" class="text-success me-2"></iconify-icon> Product comparisons</li>
                  <li><iconify-icon icon="mdi:check-circle" class="text-success me-2"></iconify-icon> Customized suggestions</li>
                </ul>
                <div class="d-flex justify-content-between align-items-center mt-3">
                  <a href="#" class="btn btn-sm btn-outline-primary">Details</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="card h-100 border-0 shadow-sm">
              <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                  <div class="icon-wrapper bg-primary bg-opacity-10 rounded-circle me-3" style="width: 60px; height: 60px;">
                    <iconify-icon icon="mdi:toolbox" class="text-primary" style="font-size: 1.8rem;"></iconify-icon>
                  </div>
                  <h4 class="mb-0">Installation Services</h4>
                </div>
                <p class="text-muted">Professional installation and setup for your purchased items.</p>
                <ul class="list-unstyled text-muted">
                  <li class="mb-1"><iconify-icon icon="mdi:check-circle" class="text-success me-2"></iconify-icon> Certified technicians</li>
                  <li class="mb-1"><iconify-icon icon="mdi:check-circle" class="text-success me-2"></iconify-icon> Same-day service available</li>
                  <li><iconify-icon icon="mdi:check-circle" class="text-success me-2"></iconify-icon> Demonstration included</li>
                </ul>
                <div class="d-flex justify-content-between align-items-center mt-3">
                  <span class="badge bg-info bg-opacity-10 text-info">New</span>
                  <a href="#" class="btn btn-sm btn-outline-primary">Details</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Shopping Services Tab -->
      <div class="tab-pane fade" id="shopping" role="tabpanel">
        <!-- Similar card structure for shopping services -->
      </div>

      <!-- Security & Returns Tab -->
      <div class="tab-pane fade" id="security" role="tabpanel">
        <!-- Similar card structure for security services -->
      </div>
    </div>

    <!-- Service Comparison Section -->
    <div class="row mt-5 pt-5">
      <div class="col-lg-10 mx-auto">
        <div class="card border-0 shadow">
          <div class="card-header bg-white py-3">
            <h3 class="mb-0 text-center">Service Level Comparison</h3>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover mb-0">
                <thead class="table-light">
                  <tr>
                    <th style="width: 25%">Feature</th>
                    <th class="text-center">Standard</th>
                    <th class="text-center">Premium</th>
                    <th class="text-center">VIP</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Delivery Speed</td>
                    <td class="text-center">3-5 business days</td>
                    <td class="text-center">Next business day</td>
                    <td class="text-center">Same day</td>
                  </tr>
                  <tr>
                    <td>Customer Support</td>
                    <td class="text-center">Email only</td>
                    <td class="text-center">24/7 Phone & Chat</td>
                    <td class="text-center">Dedicated Account Manager</td>
                  </tr>
                  <tr>
                    <td>Returns Window</td>
                    <td class="text-center">14 days</td>
                    <td class="text-center">30 days</td>
                    <td class="text-center">60 days</td>
                  </tr>
                  <tr>
                    <td>Shipping Costs</td>
                    <td class="text-center">$5.99 per order</td>
                    <td class="text-center">Free over $50</td>
                    <td class="text-center">Always free</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- FAQ Section -->
    <div class="row mt-5">
      <div class="col-lg-8 mx-auto">
        <h3 class="text-center mb-4">Frequently Asked Questions</h3>
        <div class="accordion" id="servicesFAQ">
          <div class="accordion-item border-0 shadow-sm mb-3">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                How do I track my order?
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#servicesFAQ">
              <div class="accordion-body">
                You'll receive a tracking number via email as soon as your order ships. Use this number on our tracking page or with the carrier's website for real-time updates.
              </div>
            </div>
          </div>
          <div class="accordion-item border-0 shadow-sm mb-3">
            <h2 class="accordion-header" id="headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                What is your return policy?
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#servicesFAQ">
              <div class="accordion-body">
                We offer a 30-day return policy for most items. Some exclusions apply. Returns are free with our prepaid return label service. Refunds are processed within 2 business days of receiving your return.
              </div>
            </div>
          </div>
          <!-- More FAQ items -->
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Link Bootstrap CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<?php
include "footer.php";
?>