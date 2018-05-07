   	<!-- START PAGE SIDEBAR -->
   	<div class="page-sidebar">
   		<!-- START X-NAVIGATION -->
   		<ul class="x-navigation">
   			<li class="xn-logo">
   				<a href="index.html">Logo</a>
   				<a href="#" class="x-navigation-control"></a>
   			</li>
   			<li class="xn-profile">
   				<div class="profile-mini">
   					<img src="assets/images/users/avatar.jpg" alt="John Doe"/>
   				</div>
   				<div class="profile">
   					<div class="profile-image">
   						<img src="assets/images/users/avatar.jpg" alt="John Doe"/>
   					</div>
   					<div class="profile-data">
   						<div class="profile-data-name">John Doe</div>
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
   	</div>
   	<!-- END PAGE SIDEBAR -->


