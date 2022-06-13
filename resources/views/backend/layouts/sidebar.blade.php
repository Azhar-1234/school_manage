  <aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                
                <li class="active">
                    <a href="index.html"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                </li>                   
               <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>User Manager</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-table"></i><a href="{{route('view-user')}}">view user</a></li>
                    </ul>
                </li>                    
               <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Mange setup</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-circle"></i><a href="{{route('view-class')}}">Student class</a></li>
                        <li><i class="fa fa-circle"></i><a href="{{route('view-year')}}">Student Year</a></li>
                        <li><i class="fa fa-circle"></i><a href="{{route('view-group')}}">Student group</a></li>
                        <li><i class="fa fa-circle"></i><a href="{{route('view-shift')}}">Student Shift</a></li>
                        <li><i class="fa fa-circle"></i><a href="{{route('view-feeCategory')}}">Fee Category</a></li>
                        <li><i class="fa fa-circle"></i><a href="{{route('view-feeAmount')}}">Fee Amount</a></li>
                        <li><i class="fa fa-circle"></i><a href="{{route('view-exam')}}">Exam Type</a></li>
                        <li><i class="fa fa-circle"></i><a href="{{route('view-subject')}}">Subject</a></li>
                        <li><i class="fa fa-circle"></i><a href="{{route('view-assign-subject')}}">Assign Subject</a></li>
                        <li><i class="fa fa-circle"></i><a href="{{route('view-designation')}}">Designation</a></li>
                    </ul>
                </li>                     
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Mange Students</a> 
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-circle"></i><a href="{{route('view-student')}}">Registration Students</a></li>
                        <li><i class="fa fa-circle"></i><a href="{{route('view-roll')}}">Roll Generate</a></li>
                        <li><i class="fa fa-circle"></i><a href="{{route('view-reg-fee')}}">Registration Fee</a></li>
                        <li><i class="fa fa-circle"></i><a href="{{route('view-month-fee')}}">Monthly Fee</a></li>
                        <li><i class="fa fa-circle"></i><a href="{{route('view-exam-fee')}}">Exam Fee</a></li>
                    </ul>
                 </li>                       
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Mange Emaployee</a> 
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-circle"></i><a href="{{route('view-reg-employee')}}">Registration Employee</a></li>
                        <li><i class="fa fa-circle"></i><a href="{{route('view-salary-employee')}}">Employee Salary</a></li>
                        <li><i class="fa fa-circle"></i><a href="{{route('view-leave-employee')}}">Employee Leave</a></li>
                        <li><i class="fa fa-circle"></i><a href="{{route('view-attend-employee')}}">Employee Attendace</a></li>
                        <li><i class="fa fa-circle"></i><a href="{{route('view-monthly-salary')}}">Employee Monthly Salary</a></li>
                    </ul>
                 </li>   
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Mange Emaployee</a> 
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-circle"></i><a href="{{route('view-reg-employee')}}">Registration Employee</a></li>
                        <li><i class="fa fa-circle"></i><a href="{{route('view-salary-employee')}}">Employee Salary</a></li>
                        <li><i class="fa fa-circle"></i><a href="{{route('view-leave-employee')}}">Employee Leave</a></li>
                        <li><i class="fa fa-circle"></i><a href="{{route('view-attend-employee')}}">Employee Attendace</a></li>
                        <li><i class="fa fa-circle"></i><a href="{{route('view-monthly-salary')}}">Employee Monthly Salary</a></li>
                    </ul>
                 </li> 
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="menu-icon fa fa-table"></i>Mange Marks</a> 
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-circle"></i><a href="{{route('add-marks')}}">Marks Entry</a></li>
                        <li><i class="fa fa-circle"></i><a href="{{route('edit-marks')}}">Edit Marks</a></li>
                        <li><i class="fa fa-circle"></i><a href="{{route('view-marks-grade')}}">Grade Point</a></li>
                        <li><i class="fa fa-circle"></i><a href="{{route('result-view')}}">Result</a></li>
                    </ul>
                 </li>               
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="menu-icon fa fa-table"></i>Accounts Managment</a> 
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-circle"></i><a href="{{route('Accounts-fee-view')}}">Students Fee</a></li>
                        <li><i class="fa fa-circle"></i><a href="{{route('Accounts-employee-view')}}">Employee Mangment</a></li>
                        <li><i class="fa fa-circle"></i><a href="{{route('other-cost-view')}}">Other Cost</a></li>
                     </ul>
                 </li>            
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="menu-icon fa fa-table"></i>Report Managment</a> 
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-circle"></i><a href="{{route('profit-view')}}">Monthly Profit</a></li>
                        <li><i class="fa fa-circle"></i><a href="{{route('marksheet-view')}}">Marksheet Mangment</a></li>
                        <li><i class="fa fa-circle"></i><a href="{{route('attendance-report')}}">Attendance Report</a></li>
                     </ul>
                 </li>

            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
