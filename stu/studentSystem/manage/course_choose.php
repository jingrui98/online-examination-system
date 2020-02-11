<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8"> 
   <title>学生 学习课程</title>
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
		<div class="col-md-12 column">
            <p></p>
		</div>
	</div>
	<div class="row clearfix">
		<div class="col-md-1 column"></div>
		<div class="col-md-10 column">
			<div class="alert alert-dismissable alert-info">
                <?php
					$result=mysqli_query($con,"select * from student_account where student_id='${_SESSION["student_id"]}'");
					$bookinfo=mysqli_fetch_array($result);
					$student_name=$bookinfo["student_name"];
					$student_id=$bookinfo["student_id"];
					$result=mysqli_query($con,"select * from student_course where student_id='{$student_id}'");
					$bookinfo=mysqli_fetch_array($result);
					$student_course_id=$bookinfo["course_id"];
				?>
                <h4><strong>欢迎你，<?php echo "$student_name"?>！</strong></h4>
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
		<div class="col-md-1 column"></div>
	</div>
	<div class="row clearfix">
		<div class="col-md-1 column"></div>
		<div class="col-md-3 column">
			 <button type="button" class="btn btn-default btn-block btn-info" onclick="window.location.href='index.php'">首页显示</button>
			 <button type="button" class="btn btn-default btn-block btn-warning" onclick="window.location.href='course_choose.php'">学习课程</button>
			 <button type="button" class="btn btn-default btn-block btn-info" onclick="window.location.href='do_question.php?degree=1'">题目测验</button>
			 <button type="button" class="btn btn-default btn-block btn-info" onclick="window.location.href='question_condition.php'">做题情况</button>
			 <button type="button" class="btn btn-default btn-block btn-info" onclick="window.location.href='wrong_question_record.php'">错题记录</button>
			 <button type="button" class="btn btn-default btn-block btn-info" onclick="window.location.href='leave_message.php'">教师留言</button>
			 <button type="button" class="btn btn-default btn-block btn-info" onclick="window.location.href='edit_password.php'">修改密码</button>
		</div>
		<div class="col-md-7 column">
            <?php
                $result=mysqli_query($con,"select * from id_course;");
                if($result && mysqli_num_rows($result)){
					$num=1;
					echo '<p><strong>已有课程信息：</strong><br>你可以在如下列表中更改你的选项。绿色代表可选，红色代表已经选择。</p>';
					echo '<table class="table table-bordered table-hover"><thead><tr><th>课程编号</th><th>课程名</th>';
					echo '<th>选择课程</th></tr></thead><tbody>';
                    while($row=mysqli_fetch_assoc($result)){
						if($num%2==0){
                            echo '<tr class="success">';
                        }else{
                            echo '<tr>';
                        }
                        echo '<td>'.$row['course_id'].'</td>';
                        echo '<td>'.$row['course_name'].'</td>';
                        if($row['course_id']==$student_course_id){
                            echo '<td>';
                            echo '<button type="button" class="btn btn-default btn-block btn-danger btn-xs">已选此课程</button>';
                            echo '</td>';
                        }else{
                            echo '<td>';
                            echo '<button type="button" class="btn btn-default btn-block btn-success btn-xs" onclick="window.location.href=\'course_choose_action.php?id='.$row['course_id'].'\''.'">选择此课程</button>';
                            echo '</td>';
                        }
                        $num++;
                    }
                }else{
                    echo '<strong>'.'暂时未开设课程，无法选择！'.'</strong>';
                }
            ?>
					</tbody>
					</table>
		</div>
		<div class="col-md-1 column"></div>
	</div>
	<div class="row clearfix">
		<div class="col-md-1 column"></div>
		<div class="col-md-10 column">
            <p><br></p>
		</div>
		<div class="col-md-1 column"></div>
	</div>
</div>

</body>