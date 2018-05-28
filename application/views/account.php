 <div class="col-md-6">
   <h2 >Account</h2>
   <form action="<?php echo site_url()?>/users/update" class="form-horizontal" method="post">
    <div class="form-group">
      <div class="col-xs-12">
        <label for="pwd">Change Password:</label>
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
      </div>
    </div>
    <div class="form-group">
      <div class="col-xs-12">
        <label >Display Name</label>
        <input type="text" class="form-control"  name="display_name" value="<?php echo $data['name']?>">
      </div>
    </div>

    <div class="form-group">

      <div class="col-xs-12">
        <label>Language Interface</label>
        <select class="form-control" name="lang">
          <option value="en" <?php if ($data['lang']=='en'){echo "selected";} ?>>English</option>
          <option value="ru" <?php if ($data['lang']=='ru'){echo "selected";} ?>>Русский</option>
        </select>
      </div>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>   
</div>
<div class="col-md-5">
  <h2 class="text-center">Enter Promo Code</h2>
  <form action="<?php echo site_url()?>/users/redeem_code" class="form-horizontal" method="post">
    <div class="form-group">
      <div class="col-xs-12">
        <label for="pwd">Promo Code:</label>
        <input type="text" class="form-control" placeholder="Enter Promo Code" name="promo_code" required="">
      </div>
    </div>
    <button type="submit" class="btn btn-warning">Submit</button>
  </form>
</div>