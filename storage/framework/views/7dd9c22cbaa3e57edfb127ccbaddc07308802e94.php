<form action="<?php echo e(route('Admin.usermanage.update', $user->id)); ?>" method="put">
    <?php echo csrf_field(); ?>
    <div class="modal-header bg-dark">
        <h5 class="modal-title text-white"><i class="fa fa-edit"></i> Update User</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">
        <div id="validate-error"></div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input required="" type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="<?php echo e($user->name); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="user_role">DESIGNATION </label>
                    <select required="" type="text" class="form-control" id="user_role" name="user_role">
                        <option value="<?php echo e($user->user_role); ?>"><?php echo e($user->role_name); ?></option>
                        <option value="">-----</option>
                        <?php $__currentLoopData = $Userrole; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Userroledata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($Userroledata->id); ?>">
                            <?php echo e($Userroledata->role_name); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                   
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input required="" type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile" value="<?php echo e($user->mobile); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input required="" type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="<?php echo e($user->email); ?>">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control" id="address" name="address" placeholder="Enter Address"><?php echo e($user->address); ?></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input required="" type="text" class="form-control" id="username" name="username" placeholder="Enter Username" value="<?php echo e($user->username); ?>">
                </div>
            </div>
           
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select required="" class="form-control" id="status" name="status" placeholder="Enter Status">
                        <option <?php if($user->status=="Active"): ?><?php echo e('selected'); ?><?php endif; ?> value="Active">Active</option>
                        <option <?php if($user->status=="Inactive"): ?><?php echo e('selected'); ?><?php endif; ?> value="Inactive">Inactive</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="status">Admin ? </label>
                    <select required="" class="form-control" id="admin" name="admin">

                        <option <?php if($user->admin=="1"): ?><?php echo e('selected'); ?><?php endif; ?> value="1">
                            Yes
                        </option>
                        <option <?php if($user->admin=="0"): ?><?php echo e('selected'); ?><?php endif; ?> value="0">
                            No
                        </option>

                    </select>
                </div>
            </div>

            

            <div class="col-md-6">
                <div class="form-group">
                    <label for="status">Accounts ? </label>
                    <select required="" class="form-control" id="accounts" name="accounts">

                        <option <?php if($user->accounts=="1"): ?><?php echo e('selected'); ?><?php endif; ?> value="1">
                            Yes
                        </option>
                        <option <?php if($user->accounts=="0"): ?><?php echo e('selected'); ?><?php endif; ?> value="0">
                            No
                        </option>

                    </select>
                </div>
            </div>
            
<!-- 
            <div class="col-md-3">
                <div class="form-group">
                    <label for="status">Can Create ? </label>
                    <select required="" class="form-control" id="create_per" name="create_per">

                        <option <?php if($user->create_per=="1"): ?><?php echo e('selected'); ?><?php endif; ?> value="1">
                            Yes
                        </option>
                        <option <?php if($user->create_per=="0"): ?><?php echo e('selected'); ?><?php endif; ?> value="0">
                            No
                        </option>

                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="status">Can Edit ? </label>
                    <select required="" class="form-control" id="edit_per" name="edit_per">

                        <option <?php if($user->edit_per=="1"): ?><?php echo e('selected'); ?><?php endif; ?> value="1">
                            Yes
                        </option>
                        <option <?php if($user->edit_per=="0"): ?><?php echo e('selected'); ?><?php endif; ?> value="0">
                            No
                        </option>

                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="status">Can Delete ? </label>
                    <select required="" class="form-control" id="delete_per" name="delete_per">

                        <option <?php if($user->delete_per=="1"): ?><?php echo e('selected'); ?><?php endif; ?> value="1">
                            Yes
                        </option>
                        <option <?php if($user->delete_per=="0"): ?><?php echo e('selected'); ?><?php endif; ?> value="0">
                            No
                        </option>

                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="status">Can Report View ? </label>
                    <select required="" class="form-control" id="report_per" name="report_per">

                        <option <?php if($user->report_per=="1"): ?><?php echo e('selected'); ?><?php endif; ?> value="1">
                            Yes
                        </option>
                        <option <?php if($user->report_per=="0"): ?><?php echo e('selected'); ?><?php endif; ?> value="0">
                            No
                        </option>

                    </select>
                </div>
            </div>
 -->

        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-inverse-dark" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
        <button type="submit" class="btn btn-dark"><i class="fa fa-check-square-o"></i> Simpan</button>
    </div>
</form><?php /**PATH C:\xampp\htdocs\sislak\resources\views/admin/users/edit.blade.php ENDPATH**/ ?>