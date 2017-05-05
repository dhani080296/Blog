<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
            <?php if(!$posts->count()): ?>
            <div class="alert alert-warning">
                <p>Nothing Found</p>
            </div>
            <?php else: ?>
            <?php if(isset($categoryName)): ?>
            <div class="alert alert-info">
                <p>Category: <strong><?php echo e($categoryName); ?></strong></p>
            </div>
            
            <?php endif; ?>
            <?php if(isset($authorName)): ?>
            <div class="alert alert-info">
                <p>Author: <strong><?php echo e($authorName); ?></strong></p>
            </div>
            <?php endif; ?>
             <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
              <!-- <?php if($post->category_id != config('cms.default_category_id')): ?> -->
                <article class="post-item">
                <?php if($post->image_url): ?>
                    <div class="post-item-image">
                        <a href="<?php echo e(route('blog.show',$post->slug)); ?>">
                            <img src="<?php echo e($post->image_url); ?>" alt="">
                        </a>
                    </div>
                    <?php endif; ?>

                    <div class="post-item-body">
                        <div class="padding-10">
                            <h2><a href="<?php echo e(route('blog.show',$post->slug)); ?>"><?php echo e($post->title); ?></a></h2>
                            <?php echo $post->excerpt_html; ?>

                        </div>

                        <div class="post-meta padding-10 clearfix">
                            <div class="pull-left">
                                <ul class="post-meta-group">
                                    <li><i class="fa fa-user"></i><a href="<?php echo e(route('author',$post->author->slug)); ?>"><?php echo e($post->author->name); ?></a></li>
                                    <li><i class="fa fa-clock-o"></i><time><?php echo e($post->date); ?></time></li>
                                   <li><i class="fa fa-folder"></i><a href=""> <?php echo e($post->category->title); ?></a></li>
                                    <li><i class="fa fa-comments"></i><a href="#">4 Comments</a></li>
                                </ul>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo e(route('blog.show',$post->slug)); ?>">Continue Reading &raquo;</a>
                            </div>
                        </div>
                    </div>
                </article>
                <!-- <?php endif; ?> -->
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                <?php endif; ?>
                <nav>
                <ul class="pager">
                  <?php echo e($posts->links()); ?>

                  </ul>
                </nav>
            </div>
            <?php echo $__env->make('layout.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>

  
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
