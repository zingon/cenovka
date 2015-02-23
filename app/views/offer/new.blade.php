<div class="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Nový dokument</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                <div class="col-sm-12">
                    <div class="alert hidden" role="alert">
                        <ul>&nbsc;</ul>
                    </div>
                </div>
                    <div class="col-sm-3">
                        <ol>
                            <li>Vytvoření nabídky <span class="create glyphicon glyphicon-ok hidden"></span></li>
                            <li>Přidání položek do nabídky <span class=" new glyphicon glyphicon-ok hidden"></span></li>
                        </ol>
                    </div>
                    <div class="col-sm-9 create">

                        {{Form::open(array('route'=>'document.store','id'=>'documentNew','class'=>'form-horizontal'))}}
                        <div class="form-group">
                            {{Form::label('name','Jméno',array('class'=>'col-sm-2'))}}
                            <div class="col-sm-10">
                                {{Form::text('name','',array('class'=>'form-control','placeholder'=>'Název'))}}
                            </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('dodavatel','Dodavatel:',array('class'=>'col-sm-2'))}}
                            <div class="col-sm-4">
                                {{{$dodavatel->name}}}
                            </div>
                            {{Form::label('odberatel','Odběratel:',array('class'=>'col-sm-2'))}}
                            <div class="col-sm-4">
                                {{Form::select('odberatel',$odberatele,'',array('class'=>'form-control'))}}
                            </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('vystaven','Vystaven:',array('class'=>'col-sm-2'))}}
                            <div class="col-sm-4">
                                {{Form::text('vystaven', date('Y-m-d',time()), array('id'=>'vystaven','class'=>'form-control'));}}
                            </div>
                            {{Form::label('expire','Konec platnosti nabídky',array('class'=>'col-sm-2'))}}
                            <div class="col-sm-4">
                                {{Form::text('expire', date('Y-m-d',time()), array('id'=>'expire','class'=>'form-control'));}}
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('dph','DPH:',array('class'=>'col-sm-2'))}}
                            <div class="col-sm-10">
                                {{Form::select('dph',array('21'=>'21%','15'=>'15%','0'=>'0%'),'',array('class'=>'form-control'))}}
                            </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('note', 'Poznámka:',array('class'=>'col-sm-2'))}}
                            <div class="col-sm-10">
                                {{Form::textarea('note','',array('class'=>'form-control','rows'=>'3'))}}
                            </div>
                        </div>
                        {{Form::close()}}
                    </div>
                    <div class="hidden col-sm-9 new">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-default closeModal" data-dismiss="modal" form="categoryNew">Zavřít</button>
                <button type="button" class="btn btn-primary send" form="documentNew">Další krok</button>
                <button type="submit" class="btn btn-primary create hidden" form="documentNewItems">Další krok</button>
            </div>
            </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <script type="text/javascript">
            $(document).ready(function(){
                var date = new Date();
                $( "#vystaven" ).datepicker();
                $( "#vystaven" ).datepicker("option", "dateFormat","yy-mm-dd");
                $( "#vystaven" ).datepicker('setDate', date);
                date.setMonth(date.getMonth() + 1);
                $( "#expire").datepicker();
                $( "#expire" ).datepicker("option", "dateFormat","yy-mm-dd");
                $( "#expire" ).datepicker('setDate', date);
                

                $('button.send').click(function(){
                    $("div.alert ul").text("");
                    $("div.alert").addClass('hidden');
                    $.post('{{route("document.store")}}',$("#documentNew").serialize(),function(data){
                        messagesParser(data.m,data.type,addMessage);
                        if(data.type === "success"){
                            $("span.create").removeClass('hidden');
                            $("div.create").addClass('hidden');
                            $("div.new").removeClass('hidden');
                            $("button.create").removeClass("hidden");
                            $("button.send").addClass('hidden');
                            getToken();
                        }
                    },
                    'json');
                });

                $.get('{{route("select.create")}}',function(html){
                    $('div.new').html('');
                    $('div.new').html(html);

/*                    $("button.create").click(function(){                        
                        $.post("{{route('select.store')}}",$("form#documentNewItems").serialize(),function(){
                            console.log('jo odesláno');
                        });
                    });
                },"html").fail(function() {
                    $("div.alert ul").text("");
                    addMessage("danger","Chyba při načítání položek.");
                }); */

            });
            });
            
            </script>