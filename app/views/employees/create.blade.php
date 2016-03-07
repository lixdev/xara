@extends('layouts.main')

{{HTML::script('media/jquery-1.8.0.min.js') }}

<style>
#imagePreview {
    width: 180px;
    height: 180px;
    background-position: center center;
    background-size: cover;
    background-image:url("{{asset('/public/uploads/employees/photo/default_photo.png') }}");
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
}
#signPreview {
    width: 180px;
    height: 100px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    background-image:url("{{asset('/public/uploads/employees/signature/sign_av.jpg') }}");
    display: inline-block;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
    $("#uploadFile").on("change", function()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
        
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
            
            reader.onloadend = function(){ // set image data as background of div
                $("#imagePreview").css("background-image", "url("+this.result+")");
            }
        }
    });

    $('#bank_id').change(function(){
        $.get("{{ url('api/dropdown')}}", 
        { option: $(this).val() }, 
        function(data) {
            $('#bbranch_id').empty(); 
            $.each(data, function(key, element) {
                $('#bbranch_id').append("<option value='" + key +"'>" + element + "</option>");
            });
        });
    });
});
</script>


<script type="text/javascript">
$(document).ready(function() {
    $("#signFile").on("change", function()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
        
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
            
            reader.onloadend = function(){ // set image data as background of div
                $("#signPreview").css("background-image", "url("+this.result+")");
            }
        }
    });
});
</script>

@section('content')
<br/>

<div class="row">
  <div class="col-lg-12">
  <h3>New Employee</h3>

<hr>
</div>  
</div>


<div class="row">
  <div class="col-lg-12">

    
    
     @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif

     <form method="POST" action="{{{ URL::to('employees') }}}" accept-charset="UTF-8" enctype="multipart/form-data">

            <div class="row">
            
<!--
            <div class="col-lg-3">

                 <fieldset>
                    <div class="form-group">
                        <label for="username">Member Photo</label>
                        <input  type="file" name="photo" id="name">
                    </div>


                     <div class="form-group">
                        <label for="username">Member Signature</label>
                        <input  type="file" name="signature" id="signature" >
                    </div>
                </fieldset>

            </div>

-->
            <div class="col-lg-4">

                 <fieldset>
                   <div class="form-group"><h3 style='color:Green;strong'>Personal Details</h3></div>

                    <div class="form-group">
                        <label for="username">Personal File Number <span style="color:red">*</span></label>
                        <input class="form-control" placeholder="" type="text" name="personal_file_number" id="personal_file_number" value="{{{ Input::old('personal_file_number') }}}" >
                    </div>

                    <div class="form-group">
                        <label for="username">Surname <span style="color:red">*</span></label>
                        <input class="form-control" placeholder="" type="text" name="lname" id="lname" value="{{{ Input::old('lname') }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">First Name <span style="color:red">*</span></label>
                        <input class="form-control" placeholder="" type="text" name="fname" id="fname" value="{{{ Input::old('fname') }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Other Names </label>
                        <input class="form-control" placeholder="" type="text" name="mname" id="mname" value="{{{ Input::old('mname') }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">ID Number <span style="color:red">*</span></label>
                        <input class="form-control" placeholder="" type="text" name="identity_number" id="identity_number" value="{{{ Input::old('identity_number') }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Passport number</label>
                        <input class="form-control" placeholder="" type="text" name="passport_number" id="passport_number" value="{{{ Input::old('passport_number') }}}">
                    </div>


                    <div class="form-group">
                        <label for="username">Date of birth</label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input class="form-control datepicker1" readonly="readonly" placeholder="" type="text" name="dob" id="dob" value="{{{ Input::old('dob') }}}">
                    </div>
                    </div>

                    <div class="form-group">
                        <label for="username">Marital Status</label>
                        <select name="status" class="form-control">
                            <option></option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Separated">Separated</option>
                            <option value="Widowed">Widowed</option>
                            <option value="Others">Others</option>
                        </select>
                
                    </div>

                    <div class="form-group">
                        <label for="username">Citizenship</label>
                        <select name="citizenship" class="form-control">
                            <option></option>
                            <option value="Kenyan">Kenyan</option>
                            <option value="Ugandian">Ugandan</option>
                            <option value="Tanzanian">Tanzanian</option>
                            <option value="Others">Others</option>
                        </select>
                
                    </div>
                    
                    <div class="form-group">
                        <label for="username">Education Background</label>
                        <select name="education" id="education" class="form-control">
                            <option></option>
                            @foreach($educations as $education)
                            <option value="{{ $education->id }}"> {{ $education->education_name }}</option>
                            @endforeach

                        </select>
                
                    </div>


                    <div class="form-group">
                        <label for="username">Gender</label><br>
                        <input class=""  type="radio" name="gender" id="gender" value="male"> Male
                        <input class=""  type="radio" name="gender" id="gender" value="female"> Female
                    </div>

                    <div class="form-group">
                        <label for="username">Photo</label><br>
                        <div id="imagePreview"></div>
                        <input class="img" placeholder="" type="file" name="image" id="uploadFile" value="{{{ Input::old('image') }}}">
                    </div>
            
                     <div class="form-group">
                        <label for="username">Signature</label><br>
                        <div id="signPreview"></div>
                        <input class="img" placeholder="" type="file" name="signature" id="signFile" value="{{{ Input::old('signature') }}}">
                    </div>

                </fieldset>

            </div>

            <div class="col-lg-4">

                 <fieldset>
                    <div class="form-group"><h3 style='color:Green;strong'>Pin Information</h3></div>
                    <div class="form-group">
                        <label for="username">KRA Pin</label>
                        <input class="form-control" placeholder="" type="text" name="pin" id="pin" value="{{{ Input::old('pin') }}}">
                    </div>

                     <div class="form-group">
                        <label for="username">Nssf Number</label>
                        <input class="form-control" placeholder="" type="text" name="social_security_number" id="social_security_number" value="{{{ Input::old('social_security_number') }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Nhif Number</label>
                        <input class="form-control" placeholder="" type="text" name="hospital_insurance_number" id="hospital_insurance_number" value="{{{ Input::old('hospital_insurance_number') }}}">
                    </div>
                     </fieldset>
                     <br><br><br><br>
                     <fieldset>
                      
                      <div class="form-group"><h3 style='color:Green;strong;margin-top:15px'>Deductions Applicable</h3></div>

                        <div class="checkbox">
                        <label>
                            <input type="checkbox" checked name="i_tax">
                              Apply Income Tax
                        </label>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" checked name="i_tax_relief">
                               Apply Income Tax Relief
                        </label>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" checked name="a_nssf">
                               Apply Nssf
                        </label>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" checked name="a_nhif">
                                Apply Nhif
                        </label>
                    </div>
                     </fieldset>
                     <br><br><br><br>

                     <fieldset>
                    <div class="form-group"><h3 style='color:Green;strong'>Payment Information</h3></div>

                    <div class="form-group">
                        <label for="username">Mode of Payment</label>
                        <select name="modep" class="form-control">
                            <option></option>
                            <option value="Bank">Bank</option>
                            <option value="Cash">Cash</option>
                            <option value="Cheque">Cheque</option>
                        </select>
                
                    </div>                    

                    <div class="form-group">
                        <label for="username">Bank</label>
                        <select name="bank_id" id="bank_id" class="form-control">
                            <option></option>
                            @foreach($banks as $bank)
                            <option value="{{ $bank->id }}"> {{ $bank->bank_name }}</option>
                            @endforeach

                        </select>
                
                    </div>

                      
                     <div class="form-group">
                        <label for="username">Bank Branch</label>
                        <select name="bbranch_id" id="bbranch_id" class="form-control">
                            <option></option>
                            
                        </select>
                
                    </div>

                    <div class="form-group">
                        <label for="username">Bank Account Number</label>
                        <input class="form-control" placeholder="" type="text" name="bank_account_number" id="bank_account_number" value="{{{ Input::old('bank_account_number') }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Bank Eft Code</label>
                        <input class="form-control" placeholder="" type="text" name="bank_eft_code" id="bank_eft_code" value="{{{ Input::old('bank_eft_code') }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Swift Code</label>
                        <input class="form-control" placeholder="" type="text" name="swift_code" id="swift_code" value="{{{ Input::old('swift_code') }}}">
                    </div>
                     

              </fieldset>

            </div>

            <div class="col-lg-4">

                 <fieldset>
                    <div class="form-group"><h3 style='color:Green;strong'>Company Information</h3></div>
                    <div class="form-group">
                        <label for="username">Employee Branch <span style="color:red">*</span></label>
                        <select name="branch_id" class="form-control">
                            <option></option>
                            @foreach($branches as $branch)
                            <option value="{{ $branch->id }}"> {{ $branch->name }}</option>
                            @endforeach

                        </select>
                
                    </div>


                     <div class="form-group">
                        <label for="username">Employee Department <span style="color:red">*</span></label>
                        <select name="department_id" class="form-control">
                            <option></option>
                            @foreach($departments as $department)
                            <option value="{{$department->id }}"> {{ $department->department_name }}</option>
                            @endforeach

                        </select>
                
                    </div>

                     <div class="form-group">
                        <label for="username">Job Group</label>
                        <select name="jgroup_id" class="form-control">
                            <option></option>
                            @foreach($jgroups as $jgroup)
                            <option value="{{ $jgroup->id }}"> {{ $jgroup->job_group_name }}</option>
                            @endforeach

                        </select>
                
                    </div>


                     <div class="form-group">
                        <label for="username">Employee Type</label>
                        <select name="type_id" class="form-control">
                            <option></option>
                            @foreach($etypes as $etype)
                            <option value="{{$etype->id }}"> {{ $etype->employee_type_name }}</option>
                            @endforeach

                        </select>
                
                    </div>
                    
                    <div class="form-group">
                        <label for="username">Work Permit Number</label>
                        <input class="form-control" placeholder="" type="text" name="work_permit_number" id="work_permit_number" value="{{{ Input::old('work_permit_number') }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Job Title</label>
                        <input class="form-control" placeholder="" type="text" name="jtitle" id="jtitle" value="{{{ Input::old('jtitle') }}}">
                    </div>

                    <div class="form-group">
            
                        <label for="username">Basic Salary</label>
                        <input class="form-control" placeholder="" type="text" name="pay" id="pay" value="{{{ Input::old('pay') }}}">
                        <script type="text/javascript">
                        $(document).ready(function() {
                        $('#pay').priceFormat();
                        });
                     </script>
                    </div>

                    <div class="form-group">
                        <label for="username">Date joined</label>
                        <div class="right-inner-addon ">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <input class="form-control datepicker"  readonly="readonly" placeholder="" type="text" name="djoined" id="djoined" value="{{{ Input::old('djoined') }}}">
                        </div>
                        </div>

                    <div style='margin-top:0px'></div>

                    <fieldset>

                    <div class="form-group"><h3 style='color:Green;strong'>Contact Information</h3></div>
                    <div class="form-group">
                        <label for="username">Phone Number</label>
                        <input class="form-control" placeholder="" type="text" name="telephone_mobile" id="telephone_mobile" value="{{{ Input::old('telephone_mobile') }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Office Email <span style="color:red">*</span></label>
                        <input class="form-control" placeholder="" type="text" name="email_office" id="email_office" value="{{{ Input::old('email_office') }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Personal Email</label>
                        <input class="form-control" placeholder="" type="text" name="email_personal" id="email_personal" value="{{{ Input::old('email_personal') }}}">
                    </div>

                    <div class="form-group">
                        <label for="username">Postal Zip</label>
                        <input class="form-control" placeholder="" type="text" name="zip" id="zip" value="{{{ Input::old('zip') }}}">
                    </div>

                     <div class="form-group">
                        <label for="username">Postal Address</label>
                        <textarea class="form-control"  name="address" id="address">{{{ Input::old('address') }}}</textarea>
                    </div>

                  
                   </fieldset>
                  
                   <fieldset>
                    
                     <div class="checkbox">
                        <label>
                            <input type="checkbox" checked name="active">
                                In Employment
                        </label>
                    </div>
                      
                    </fieldset>

                    <div style='margin-top:80px'></div>

                    </fieldset>
                    
                        <div class="form-actions form-group">
        
                            <button type="submit" class="btn btn-primary btn-sm">Create Employee</button>
                        </div>

                    
                </fieldset>

            </div>
</div>


<div class="row">


             <div class="col-lg-12"><hr>

                
<div class="row">


             <div class="col-lg-4">

                 <fieldset>
                    


                </fieldset>


             </div>


             <div class="col-lg-4">

                 
                     </div>


             
</div>






<div class="row">


             <div class="col-lg-4 pull-right">
   
                
            </div>

        </div>
</form>
    

  </div>

</div>


@stop