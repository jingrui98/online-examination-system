<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8"> 
   <title>学生 修改密码</title>
   <link rel="stylesheet" href="../../css/bootstrap.min.css">
</head>
<body background="..\login\images\back.png">
<?php include '../../config.php';?>
<script src="../../js/bootstrap.js"></script>
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<p><br><br></p>
		</div>
	</div>
	<div class="row clearfix">
		<div class="col-md-1 column"></div>
		<div class="col-md-4 column">
			<h3>
				题库管理与随堂测验系统<br>学生界面
			</h3>
		</div>
		<div class="col-md-2 column"></div>
		<div class="col-md-2 column">
			<p class="text-right" style="font-size:18px">
			<br><br><strong>当前账号：<?php echo "${_SESSION["student_id"]}";//显示登录用户名 ?></strong>
			</p>
		</div>
		<div class="col-md-2 column">
			<br><br><button type="button" class="btn btn-default btn-block btn-warning" onclick="window.location.href='exit.php'">注销登录</button>
		</div>
		<div class="col-md-1 column"></div>
	</div>
	<div class="row clearfix">
		<div class="col-md-12 column"><p></p></div>
	</div>
	<div class="row clearfix">
		<div class="col-md-1 column"></div>
		<div class="col-md-10 column">
			<div class="alert alert-dismissable alert-info">
				 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				 <?php
						$result=mysqli_query($con,"select * from student_account where student_id='${_SESSION["student_id"]}'");
						$bookinfo=mysqli_fetch_array($result);
						$student_id=$bookinfo["student_id"];
						$student_name=$bookinfo["student_name"];
						$student_class=$bookinfo["student_class"];
                        $password=$bookinfo["student_password"];
					?>
				<h4>
				<strong>欢迎你，<?php echo "$student_name"?>！</strong></h4>
				<?php
					$notice_check=mysqli_query($con,"select * from notice");
					$notice=mysqli_fetch_array($notice_check);
					if(!$notice){
						echo '<strong>目前暂无管理员发布的通知。</strong><br>'.'在开始使用本系统前，请详细阅读界面首页的操作使用提示！';
					}else{
						echo '<strong>'.'现有通知：'.'</strong>'.'<br>';
						mysqli_free_result($notice_check);
						$notice_check=mysqli_query($con,"select * from notice");
						while($row_notice=mysqli_fetch_assoc($notice_check)){
							echo '<strong>'.$row_notice['name'].'：</strong>'.$row_notice['content'].'<strong>发布于：</strong>'.$row_notice['time'].'<br>';
						}
					}
				?>
			</div>
		</div>
		<div class="col-md-1 column">
		</div>
	</div>
	<div class="row clearfix">
		<div class="col-md-1 column"></div>
		<div class="col-md-3 column">
			 <button type="button" class="btn btn-default btn-block btn-info" onclick="window.location.href='index.php'">首页显示</button>
			 <button type="button" class="btn btn-default btn-block btn-info" onclick="window.location.href='course_choose.php'">学习课程</button>
			 <button type="button" class="btn btn-default btn-block btn-info" onclick="window.location.href='do_question.php?degree=1'">题目测验</button>
			 <button type="button" class="btn btn-default btn-block btn-info" onclick="window.location.href='question_condition.php'">做题情况</button>
			 <button type="button" class="btn btn-default btn-block btn-info" onclick="window.location.href='wrong_question_record.php'">错题记录</button>
			 <button type="button" class="btn btn-default btn-block btn-info" onclick="window.location.href='leave_message.php'">教师留言</button>
			 <button type="button" class="btn btn-default btn-block btn-warning" onclick="window.location.href='edit_password.php'">修改密码</button>
		</div>
		<div class="col-md-7 column">
			<p><strong>您的登录信息：</strong></p>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>
							学号
						</th>
						<th>
							姓名
						</th>
						<th>
							班级
						</th>
						
						<th>
							登录日期
						</th>
					</tr>
				</thead>
				<tbody>
				<tr class="warning">
					<td>
						<?php echo "$student_id" //显示学生的编号?>
					</td>
					<td>
						<?php echo "$student_name"	//显示学生的姓名?>
					</td>
					<td>
					<?php echo "$student_class"	//显示学生的班级?>
					</td>
					
					<td>
						<?php echo date("Y-m-d");?>
					</td>
				</tr>
				</tbody>
			</table>
			<p>
				<strong>请输入需要修改的密码：</strong><br><br>
			</p>
            <form action="edit_password_action.php" method="post" role="form">
				<div class="col-md-4 column">
					<p class="text-right">
						 <strong>原来的密码：</strong><br><br><br>
						 <strong>新密码：</strong><br><br><br>
                         <strong>确认密码：</strong>
					</p>
				</div>
				<div class="col-md-4 column">
				<input type="text" name="old_password" class="form-control" id="name" placeholder="请输入原来的密码">
				<br>
				<input type="text" name="new_password" class="form-control" id="name" placeholder="请输入新密码">
                <br>
                <input type="text" name="confirm_password" class="form-control" id="name" placeholder="请重新输入新密码">
				</div>
				<div class="col-md-2 column">
					<br><br><br>
					 <button type="submit" class="btn btn-default btn-block btn-success">修改密码</button>
				</div>
				</form>
		</div>
		<div class="col-md-1 column">
		</div>
	</div>
	<div class="row clearfix">
		<div class="col-md-1 column">
		</div>
		<div class="col-md-10 column">
			<p><br></p>
		</div>
		<div class="col-md-1 column"></div>
	</div>
</div>

<?php mysqli_close($con);?>

</body>