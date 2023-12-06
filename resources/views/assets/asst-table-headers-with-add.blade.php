<div class="card-header d-flex flex-wrap align-items-center justify-content-between"
    style="background-color: #fff; color:#1f3c88">
    <p class="card-title mb-3 mb-md-0" style="color:#1f3c88; padding-left:0%; font-size: 22px"><b>Students List</b>
    </p>
    <div class="d-flex flex-wrap align-items-center ml-auto">
        <form class="form-inline mr-auto mr-md-0 mb-2 mb-md-0" style="display: flex; align-items: center;">
            <div class="nav-item dropdown show btn btn-sm rounded" id="addStudentButton"
                style="display: flex; align-items:center; height: 38px; margin-left: 4px;">
                <a href=" {{ route('students.addStudentPage') }}" class="nav-link align-items-center"
                    style="color:#fff;height: 100%; display: flex; align-items: center;"><i class="fas fa-user-plus mr-1" style="font-size: 17px"></i> Add Student</a>
            </div>
        </form>
    </div>
</div>
