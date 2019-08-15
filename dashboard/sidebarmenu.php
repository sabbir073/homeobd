<div class="az-sidebar az-sidebar-sticky az-sidebar-indigo-dark">
    <div class="az-sidebar-header">
        <a href="index.php" class="az-logo">h<span>o</span>me<span>o</span>bd</a>
    </div><!-- az-sidebar-header -->
    <div class="az-sidebar-loggedin">
        <div class="az-img-user online"><img src="./images/user.png" alt="User"></div>
        <div class="media-body">
            <h6><?php echo $name;?></h6>
            <span><?php echo $role;?></span>
        </div><!-- media-body -->
    </div><!-- az-sidebar-loggedin -->
    <?php adminmenu($role); ?>
</div><!-- az-sidebar -->