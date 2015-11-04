<div class="modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close">
        	<span aria-hidden="true">&times;</span>
        </button>
    	<h4 class="modal-title">Nová položka</h4>
   	</div>
    <div class="modal-body">
	{{Form::open(array('route'=>array('contact.update', $contact->id), "method"=>"PUT",'class'=>'form-horizontal','id'=>'contactForm'))}}
		<div class="form-group">
			{{Form::label('name','Název:',array('class'=>'col-sm-2'))}}
			<div class="col-sm-10">
				{{Form::text('name',$contact->name,array('class'=>'form-control','placeholder'=>'Název'))}}
			</div>
		</div>
		
		<div class="form-group">
			{{Form::label('firstname','Křestní jméno:',array('class'=>'col-sm-2'))}}
			<div class="col-sm-4">
				{{Form::text('firstname',$contact->firstname,array('class'=>'form-control','placeholder'=>'Křestní jméno'))}}
			</div>
			
			{{Form::label('lastname','Příjmení:',array('class'=>'col-sm-2'))}}
			<div class="col-sm-4">
				{{Form::text('lastname',$contact->lastname,array('class'=>'form-control','placeholder'=>'Příjmení'))}}
			</div>
		</div>

		<div class="form-group">
			{{Form::label('phone','Telefon:',array('class'=>'col-sm-2'))}}
			<div class="col-sm-4">
				{{Form::text('phone',$contact->phone,array('class'=>'form-control','placeholder'=>'Telefon'))}}
			</div>

			{{Form::label('email','Email:',array('class'=>'col-sm-2'))}}
			<div class="col-sm-4">
				{{Form::email('email',$contact->email,array('class'=>'form-control','placeholder'=>'Email'))}}
			</div>
		</div>

		<div class="form-group">
			{{Form::label('ic','IČ:',array('class'=>'col-sm-2'))}}
			<div class="col-sm-4">
				{{Form::text('ic',$contact->ic,array('class'=>'form-control','placeholder'=>'IČ'))}}
			</div>

			{{Form::label('dic','DIČ:',array('class'=>'col-sm-2'))}}
			<div class="col-sm-4">
				{{Form::text('dic',$contact->dic,array('class'=>'form-control','placeholder'=>'DIČ'))}}
			</div>
		</div>

		<div class="form-group">
			{{Form::label('adress','Ulice a č.p:',array('class'=>'col-sm-2'))}}
			<div class="col-sm-10">
				{{Form::text('adress',$contact->adress,array('class'=>'form-control','placeholder'=>'Ulice a č.p'))}}
			</div>
		</div>

		<div class="form-group">
			{{Form::label('city','Město:',array('class'=>'col-sm-2'))}}
			<div class="col-sm-4">
				{{Form::text('city',$contact->city,array('class'=>'form-control','placeholder'=>'Město'))}}
			</div>

			{{Form::label('zip_code','PSČ:',array('class'=>'col-sm-2'))}}
			<div class="col-sm-4">
				{{Form::text('zip_code',$contact->zip_code,array('class'=>'form-control','placeholder'=>'PSČ'))}}
			</div>
		</div>

		<div class="form-group">
			{{Form::label('note','Poznámka:',array('class'=>'col-sm-2'))}}
			<div class="col-sm-10">
				{{Form::textarea('note',$contact->note,array('class'=>'form-control','placeholder'=>'Poznámka','rows'=>'3'))}}
			</div>
		</div>

		<div class="form-group">
			<div class="checkbox">
				{{Form::label('Já','me',array('class'=>'col-sm-2'))}}
				{{Form::checkbox('me',true,$contact->me)}}
			</div>
		</div>
	{{Form::close()}}
	</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default closeModal" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="contactForm">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->