<!-- START PAGE SIDEBAR -->
<div class="page-sidebar">
  <!-- START X-NAVIGATION -->
  <ul class="x-navigation">
   <li class="xn-logo">
    <a href="/"><img src="<?php echo base_url() ?>/asset/img/logo_splash.png" class="img-responsive"></a>
    <a href="#" class="x-navigation-control"></a>
  </li>
  <li class="xn-profile">
    <div class="profile-mini">
     <!-- <img src="<?php echo base_url() ?>/asset/assets/images/users/avatar.jpg" alt="John Doe"/> -->
   </div>
   <div class="profile">
     <div class="profile-image">
     <!--   <img src="<?php echo base_url() ?>/asset/assets/images/users/avatar.jpg" alt="John Doe"/>
     -->
     <span class="fa fa-user fa-5x"></span>
   </div>
   <div class="profile-data">
    <div class="profile-data-name"><a href="<?php echo site_url() ?>/users" style="color: #222A38;">John Doe</a></div>
  </div>
</div>                                                                        
</li>
<li class="<?php if(isset($all_files)){echo $all_files;}?>">
  <a href="<?php echo site_url() ?>/home"><span class="big-icon fa fa-folder"></span> <span class="xn-text">All File</span></a>                        
</li>     
   			<!-- <li class="">
   				<a href="index.html">
   					<span class="big-icon fa fa-star">

   					</span> 
   					<span class="xn-text">Favorites</span>
   				</a>                        

   				<div class="informer informer-warning">+679</div>
   			</li>   -->   
   			<!-- <li class="">
   				<a href="index.html"><span class="big-icon fa fa-share-alt"></span> <span class="xn-text">Shared With You</span></a>                        
   			</li>   -->   
   			<li class="<?php if(isset($shared)){echo $shared;}?>">
   				<a href="<?php echo site_url()?>/Shared"><span class="big-icon fa fa-share-alt-square"></span> <span class="xn-text">Shared with other</span></a>                        
   			</li>     
   			<!-- <li class="">
   				<a href="index.html"><span class="big-icon fa fa-link"></span> <span class="xn-text">Shared by link</span></a>                        
   			</li>  -->
   			<!-- <li class="">
   				<a href="index.html"><span class="big-icon fa fa-search"></span> <span class="xn-text">Tags</span></a>                        
   			</li> 
   			<li class="">
   				<a href="index.html"><span class="big-icon fa fa-external-link"></span> <span class="xn-text">External Storage</span></a>                        
   			</li> -->
   			<li class="<?php if(isset($trash)){echo $trash;}?>">
   				<a href="<?php echo site_url()?>/trash">
   					<span class="big-icon fa fa-trash-o"></span> 
   					<span class="xn-text">Trash</span>
   				</a>     
   			</li>                
   		</ul>
   		<!-- END X-NAVIGATION -->
       <ul class="x-navigation">
        <li class="xn-profile">
         <div class="profile-mini">
          <!-- <img src="<?php echo base_url() ?>/asset/assets/images/users/avatar.jpg" alt="John Doe"/> -->
        </div>
        <div class="profile">
          <div class="profile-image">
                     <!-- <img src="<?php echo base_url() ?>/asset/assets/images/users/avatar.jpg" alt="John Doe"/>
                     -->

                   </div>
                   <div class="profile-data">
                     <div class="profile-data-name">
                      <div class="progress">    
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                          <span>7.2 MB of 50.0 GB used</span>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>                                                                        
              </li>
            </ul>
          </div>
          <!-- END PAGE SIDEBAR -->


