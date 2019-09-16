@extends('main.base')

@section('page-css')
    
@endsection

@section('page-js')

{{--For ADD FORM--}}
<script>
    var Addform = document.getElementById("AddForm");

    $('#AddBTN').click(function(){
        var catname = $('#AddCatName').val()
        if(catname == ""){
            $('#reqcatnameadd').html('Required field!').css('color', 'red');
            swal({
                title: 'Ooops!',
                text: 'Please fill out the necessary fields!',
                icon: 'error',
                buttons: {
                    confirm: {
                        visible: true,
                        className: 'btn btn-danger',
                        closeModal: true,
                    }
                }

            })
        }
        else {
            swal({
                title: 'Success!',
                text: 'Category successfully added.',
                icon: 'success',

            } );
            setTimeout(function(){ Addform.submit(); }, 1000);

        }
    });
</script>
    
@endsection

@section('content')

<!-- <div class="container-fluid">
    <div class="block-header">
        <h2>Course</h2>
    </div>
</div> -->

    <!-- Main Content Start-->

            <h2></h2>
        </div>
    </div>

    <!-- Vertical Layout | With Floating Label -->

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Course
                        <small>Configurations for Courses/Programs.</small>
                    </h2>
                    <button type="button" class="btn btn-primary m-t-15 waves-effect" data-toggle='modal' data-target='#AddModal' >ADD COURSE</button>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table main-table " >
                            <thead>
                                <tr>
                                    <th hidden>Course ID</th>
                                    <th>Course Code</th>
                                    <th>Description</th>
                                    <th>Year Level</th>
                                    <th>Semester</th>
                                    <th>Action</th>
                                </tr>
                            </thead>                                      
                            <tbody>
                                @foreach($DisplayCourse as $course )
                                <tr>
                                    <td hidden>{{$course->course_id}}</td>
                                    <td>{{$course->course_code}}</td>
                                    <td>{{$course->course_description}}</td>
                                    <td>{{$course->year_level}}</td>
                                    <td>{{$course->semester}}</td>
                                    <td>
                                        <button type='button' class='btn btn-success editCategory' data-toggle='modal' data-target='#UpdateModal'>
                                            <i class='fa fa-edit'></i> Edit
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Course Modal -->
    <div class="modal fade" id="AddModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="color: #2196F3" id="defaultModalLabel">Add Course</h4>
                </div>
                <div class="modal-body">
                    <form id="formAddCourse" method="POST">
                        <div class="row clearfix">
                            <div class="col-sm-4 col-xs-5">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="txtCourseCodeAdd">Course Code</label>
                                        <input type="text" id="txtCourseCodeAdd" class="form-control" placeholder="e.g. BSIT" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-5">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="txtYearLvlAdd">Year Level</label>
                                        <input type="text" id="txtYearLvlAdd" class="form-control" placeholder="e.g. 1" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-5">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="txtSemesterAdd">Semester</label>
                                        <input type="text" id="txtSemesterAdd" class="form-control" placeholder="e.g. First Semester" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12 col-xs-5">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="txtCourseDescAdd">Course Description</label>
                                        <input type="text" id="txtCourseDescAdd" class="form-control" placeholder="e.g. Bachelor of Science in Information Technology" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary waves-effect">SAVE CHANGES</button>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
    
@endsection

        <!-- Main Content End -->
    

