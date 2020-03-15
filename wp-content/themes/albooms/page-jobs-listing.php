<?php
get_header();
?>

<div class="hero-wrap hero-wrap-2" style="background-image: url('<?php bloginfo('stylesheet_directory');?>/images/bg_1.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-start">
          <div class="col-md-12 ftco-animate text-center mb-5">
          	<p class="breadcrumbs mb-0"><span class="mr-3"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Job Post</span></p>
            <h1 class="mb-3 bread">Job Listing</h1>
          </div>
        </div>
      </div>
    </div>
    <section class="ftco-section ftco-no-pb bg-light">
    	<div class="container">
    		<div class="row justify-content-center mb-4">
          <div class="col-md-7 text-center heading-section ftco-animate">
          	<span class="subheading">Browse Jobs</span>
            <h2 class="mb-4">Advance Search</h2>
          </div>
        </div>
    		<div class="row">
    			<div class="ftco-search">
						<div class="row">
	            <div class="col-md-12 nav-link-wrap">
		            <div class="nav nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
		              <a class="nav-link active mr-md-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Find a Job</a>

		              <a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">Find a Candidate</a>

		            </div>
		          </div>
		          <div class="col-md-12 tab-wrap">
		            
		            <div class="tab-content p-4" id="v-pills-tabContent">

		              <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
		              	<form action="#" class="search-job">
		              		<div class="row no-gutters">
		              			<div class="col-md mr-md-2">
		              				<div class="form-group">
			              				<div class="form-field">
			              					<div class="icon"><span class="icon-briefcase"></span></div>
							                <input type="text" class="form-control" placeholder="eg. Garphic. Web Developer">
							              </div>
						              </div>
		              			</div>
		              			<div class="col-md mr-md-2">
		              				<div class="form-group">
		              					<div class="form-field">
			              					<div class="select-wrap">
					                      <div class="icon"><span class="ion-ios-arrow-down"></span></div>
					                      <select name="" id="" class="form-control">
					                      	<option value="">Category</option>
					                      	<option value="">Full Time</option>
					                        <option value="">Part Time</option>
					                        <option value="">Freelance</option>
					                        <option value="">Internship</option>
					                        <option value="">Temporary</option>
					                      </select>
					                    </div>
							              </div>
						              </div>
		              			</div>
		              			<div class="col-md mr-md-2">
		              				<div class="form-group">
		              					<div class="form-field">
			              					<div class="icon"><span class="icon-map-marker"></span></div>
							                <input type="text" class="form-control" placeholder="Location">
							              </div>
						              </div>
		              			</div>
		              			<div class="col-md">
		              				<div class="form-group">
		              					<div class="form-field">
						                	<button type="submit" class="form-control btn btn-primary">Search</button>
							              </div>
						              </div>
		              			</div>
		              		</div>
		              	</form>
		              </div>

		              <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-performance-tab">
		              	<form action="#" class="search-job">
		              		<div class="row">
		              			<div class="col-md">
		              				<div class="form-group">
			              				<div class="form-field">
			              					<div class="icon"><span class="icon-user"></span></div>
							                <input type="text" class="form-control" placeholder="eg. Adam Scott">
							              </div>
						              </div>
		              			</div>
		              			<div class="col-md">
		              				<div class="form-group">
		              					<div class="form-field">
			              					<div class="select-wrap">
					                      <div class="icon"><span class="ion-ios-arrow-down"></span></div>
					                      <select name="" id="" class="form-control">
					                      	<option value="">Category</option>
					                      	<option value="">Full Time</option>
					                        <option value="">Part Time</option>
					                        <option value="">Freelance</option>
					                        <option value="">Internship</option>
					                        <option value="">Temporary</option>
					                      </select>
					                    </div>
							              </div>
						              </div>
		              			</div>
		              			<div class="col-md">
		              				<div class="form-group">
		              					<div class="form-field">
			              					<div class="icon"><span class="icon-map-marker"></span></div>
							                <input type="text" class="form-control" placeholder="Location">
							              </div>
						              </div>
		              			</div>
		              			<div class="col-md">
		              				<div class="form-group">
		              					<div class="form-field border">
							                <button type="submit" class="form-control btn btn-primary">Search</button>
							              </div>
						              </div>
		              			</div>
		              		</div>
		              	</form>
		              </div>
		            </div>
		          </div>
		        </div>
	        </div>
    		</div>
    	</div>
    </section>

    <section class="ftco-section bg-light">
			<div class="container">
				<div class="row">
					<div class="col-lg-9 pr-lg-4">
						<div class="row">
						<!-- Start of Job Post -->
						<?php 
						global $post;
						$job_post = query_posts(array(
							'post_type' => 'awsm_job_openings',
							'orderyby' => 'ASC',
							'showposts' => 10
						));
						$awsm_filters   = get_option( 'awsm_jobs_filter' );
						$listing_specs  = get_option( 'awsm_jobs_listing_specs' );					
				  	    foreach($job_post as $key => $latest_job) : 
							$post_title   =  $latest_job->post_title;
							$post_link    =  $latest_job->guid;
							$job_type     =  get_the_terms($latest_job->ID, 'job-type');
							$job_location =  get_the_terms($latest_job->ID, 'job-location');
							$job_company =  get_the_terms($latest_job->ID, 'job-company');			
					   ?>
				   <div class="col-md-12 ftco-animate">
		            <div class="job-post-item p-4 d-block d-lg-flex align-items-center">
		              <div class="one-third mb-4 mb-md-0">
		                <div class="job-post-item-header align-items-center">
		                	<span class="subadge"><?php echo $job_type[0]->name;?></span>
		                  <h2 class="mr-3 text-black"><a href="<a href="<?php echo the_permalink($latest_job->ID);?>"><?php echo $post_title;?></a></h2>
		                </div>
		                <div class="job-post-item-body d-block d-md-flex">
		                  <div class="mr-3"><span class="icon-layers"></span> <a href="#"><?php echo $job_company[0]->name;?></a></div>
		                  <div><span class="icon-my_location"></span> <span><?php echo $job_location[0]->name;?></span></div>
		                </div>
		              </div>
					

		              <div class="one-forth ml-auto d-flex align-items-center mt-4 md-md-0">
		              	<div>
			                <a href="#" class="icon text-center d-flex justify-content-center align-items-center icon mr-2">
			                	<span class="icon-heart"></span>
			                </a>
		                </div>
		                <a href="<?php echo the_permalink($latest_job->ID);?>" class="btn btn-primary py-2">Apply Job</a>
		              </div>
		            </div>
		          </div><!-- end -->
				  <!-- End of Post Data -->
				  <?php endforeach;  wp_reset_query(); ?>						
		        </div>
		        <div class="row mt-5">
		          <div class="col text-center">
		            <div class="block-27">
		              <ul>
		                <li><a href="#">&lt;</a></li>
		                <li class="active"><span>1</span></li>
		                <li><a href="#">2</a></li>
		                <li><a href="#">3</a></li>
		                <li><a href="#">4</a></li>
		                <li><a href="#">5</a></li>
		                <li><a href="#">&gt;</a></li>
		              </ul>
		            </div>
		          </div>
		        </div>
		      </div>
		      <div class="col-lg-3 sidebar">
		        <div class="sidebar-box bg-white p-4 ftco-animate">
		        	<h3 class="heading-sidebar">Browse Category</h3>
		        	<form action="#" class="search-form mb-3">
                <div class="form-group">
                  <span class="icon icon-search"></span>
                  <input type="text" class="form-control" placeholder="Search...">
                </div>
              </form>
		        	<form action="#" class="browse-form">
							  <label for="option-job-1"><input type="checkbox" id="option-job-1" name="vehicle" value="" checked> Website &amp; Software</label><br>
							  <label for="option-job-2"><input type="checkbox" id="option-job-2" name="vehicle" value=""> Education &amp; Training</label><br>
							  <label for="option-job-3"><input type="checkbox" id="option-job-3" name="vehicle" value=""> Graphics Design</label><br>
							  <label for="option-job-4"><input type="checkbox" id="option-job-4" name="vehicle" value=""> Accounting &amp; Finance</label><br>
							  <label for="option-job-5"><input type="checkbox" id="option-job-5" name="vehicle" value=""> Restaurant &amp; Food</label><br>
							  <label for="option-job-6"><input type="checkbox" id="option-job-6" name="vehicle" value=""> Health &amp; Hospital</label><br>
							</form>
		        </div>

		        <div class="sidebar-box bg-white p-4 ftco-animate">
		        	<h3 class="heading-sidebar">Select Location</h3>
		        	<form action="#" class="search-form mb-3">
                <div class="form-group">
                  <span class="icon icon-search"></span>
                  <input type="text" class="form-control" placeholder="Search...">
                </div>
              </form>
		        	<form action="#" class="browse-form">
							  <label for="option-location-1"><input type="checkbox" id="option-location-1" name="vehicle" value="" checked> Sydney, Australia</label><br>
							  <label for="option-location-2"><input type="checkbox" id="option-location-2" name="vehicle" value=""> New York, United States</label><br>
							  <label for="option-location-3"><input type="checkbox" id="option-location-3" name="vehicle" value=""> Tokyo, Japan</label><br>
							  <label for="option-location-4"><input type="checkbox" id="option-location-4" name="vehicle" value=""> Manila, Philippines</label><br>
							  <label for="option-location-5"><input type="checkbox" id="option-location-5" name="vehicle" value=""> Seoul, South Korea</label><br>
							  <label for="option-location-6"><input type="checkbox" id="option-location-6" name="vehicle" value=""> Western City, UK</label><br>
							</form>
		        </div>

		        <div class="sidebar-box bg-white p-4 ftco-animate">
		        	<h3 class="heading-sidebar">Job Type</h3>
		        	<form action="#" class="browse-form">
							  <label for="option-job-type-1"><input type="checkbox" id="option-job-type-1" name="vehicle" value="" checked> Partime</label><br>
							  <label for="option-job-type-2"><input type="checkbox" id="option-job-type-2" name="vehicle" value=""> Fulltime</label><br>
							  <label for="option-job-type-3"><input type="checkbox" id="option-job-type-3" name="vehicle" value=""> Intership</label><br>
							  <label for="option-job-type-4"><input type="checkbox" id="option-job-type-4" name="vehicle" value=""> Temporary</label><br>
							  <label for="option-job-type-5"><input type="checkbox" id="option-job-type-5" name="vehicle" value=""> Freelance</label><br>
							  <label for="option-job-type-6"><input type="checkbox" id="option-job-type-6" name="vehicle" value=""> Fixed</label><br>
							</form>
		        </div>
		      </div>
				</div>
			</div>
		</section>
		
		
		<!-- subscribe -->
		<?php get_template_part( 'template-parts/subscribe'); ?>
		<!-- end of subscribe -->

<?php
get_footer();