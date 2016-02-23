
        <fieldset>
            <!-- Email Field -->
            <section>
                {!! Form::label('email', 'Email:',['class' => 'label']) !!}
                <label class="input">{!! Form::email('email', null, ['class' => 'input-lg']) !!}</label>
            </section>

            <!-- First Name Field -->
            <section>
                {!! Form::label('first_name', 'First Name:',['class' => 'label']) !!}
                <label class="input">{!! Form::text('first_name', null, ['class' => 'input-lg']) !!}</label>
            </section>



            <!-- Last Name Field -->
            <section>
                {!! Form::label('last_name', 'Last Name:',['class' => 'label']) !!}
                <label class="input">{!! Form::text('last_name', null, ['class' => 'input-lg']) !!}</label>
            </section>

            </fieldset>

            <fieldset>

            <!-- Password Field -->
            <section>
                {!! Form::label('password', 'Password:',['class' => 'label']) !!}
                <label class="input">{!! Form::password('password', ['class' => 'input-lg']) !!}</label>
            </section>



            <!-- Confirm Password Field -->
            <section>
                {!! Form::label('password_confirmation', 'Password confirmation:') !!}
                <label class="input">{!! Form::password('password_confirmation', ['class' => 'input-lg']) !!}</label>
            </section>


            <!-- Permissions Field -->
            <section>
                <label class="label">{!! Form::label('permissions', 'Permissions:',['class' => 'label']) !!}</label>
                <label class="select">{!! Form::select('permissions', null,'', ['class' => 'input-lg']) !!}<i></i></label>
            </section>
        </fieldset>

            <!-- Submit Field -->
            <footer>
                {!! Form::button('Save', ['class' => 'btn btn-primary','type'=>'submit']) !!}
            </footer>


