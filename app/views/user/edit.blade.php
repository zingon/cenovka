{{Form::open(array('route'=> array('user.update',Auth::user()->id), "method" => "PUT"))}}
    <section>
        <div class="small-12 columns">
        <div class="row">
            <div class="small-12 columns">
                <h4>Změna hesla</h4>
            </div>
        </div>
            <div class="row"> 
                <div class="small-12 columns">
                    <label>Staré heslo<input type="password" name="old_password" placeholder="Staré heslo" required="" max="255" ></label>
                </div>
            </div>
             <div class="row"> 
                <div class="small-12 columns">
                    <label>Nové heslo<input type="password" name="new_password" placeholder="Nové heslo" required="" max="255" min="8"></label>
                </div>
            </div>
             <div class="row"> 
                <div class="small-12 columns">
                    <label>Nové heslo znovu<input type="password" name="new_password_again" placeholder="Nové heslo znovu" required="" max="255" min="8"></label>
                </div>
            </div>
            <div class="row">
                                <div class="large-12 large-centered columns">

                                        <button type="submit" class="button expand">Změnit heslo</button>
                                </div>
                            </div>
        </div>
    </section>            	
{{Form::close()}}