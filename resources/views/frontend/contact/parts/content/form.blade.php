<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <form role="form" class="register-form">
                <h2>{!! $data['heading'] !!}</h2>
                <hr class="colorgraph">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="form-group">
                            <input type="text" name="first_name" id="first_name" class="form-control input-md" placeholder="First Name" tabindex="1">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="form-group">
                            <input type="text" name="last_name" id="last_name" class="form-control input-md" placeholder="Last Name" tabindex="2">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="form-group">
                            <input type="text" name="email" id="email" class="form-control input-md" placeholder="Email" tabindex="2">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <textarea class="form-control" rows="8" placeholder="* Your comment here"></textarea>
                </div>
                <hr class="colorgraph">
                <div class="row">
                    <div class="col-xs-12 col-md-4"><input type="submit" value="Submit message" class="btn btn-theme btn-block btn-md" tabindex="7"></div>
                </div>
            </form>

        </div>
    </div>
</div>