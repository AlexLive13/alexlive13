<?php
include "head.php";

?>

<div id="back_click" class="back_click"></div><!--задний фон-->
<script>
	//индексируем задний фон в скрипте
	var back_click = document.getElementById('back_click');
</script>

<div style="margin-left: 35%; margin-top: 5%; margin-bottom: 6%;">
<a href="foto_ins.php" class="form_foto">Добавить фотографию</a>

<a href="album_ins.php" class="form_album">Создать альбом</a>
</div>

<!--сообщаем о том, что фотография загружена-->
<p style="color: yellow;"><?php echo $_GET['dir']."<b>".$_GET['dirrus']."</b>"; ?></p>

<ul id="ul" style="background-color: rgba(255, 255, 255, 0.7); width: 100%; list-style-type: none;">
<?php
$i=1;
$q="SELECT * FROM `albums`";
$res=mysql_query($q);
while($row=mysql_fetch_array($res)){
		echo "
		<li id='li".$row['id']."' class='ul_album_red'>
					<h1 id='h1".$row['id']."' class='h1_album_red'>".$row['albums']."</h1>
					
					<!--форма для редактирования названия-->
					<form id='form".$row['id']."' method='post' class='form_red' action='red_album.php'>
						<input type='hidden' name='album_id' value='".$row['id']."'>
						<input type='hidden' name='album_rus' value='".$row['albums']."'>
						<input type='text' name='album_red' value='".$row['albums']."'>
						<input type='submit' value='ok'>
					</form>
					
					";
				echo "<!--панель редактирования-->
					<div class='block_butt'>
							<!--показать-скрыть фотографии-->
							<div id='hide".$row['id']."' class='show_hide' onclick='showHide".$row['id']."()' style='display: block; padding: 6px;' title='открыть альбом'>
								<img src='images/hide.png'>
							</div>
							<div id='show".$row['id']."' class='show_hide' onclick='showHide1".$row['id']."()' style='display: none; padding: 6px;' title='закрыть альбом'>
								<img src='images/show.png'>
							</div>
							
							<!--редактирование названия альбома-->
							<div id='ch".$row['id']."' onclick='change".$row['id']."()' class='change_alb' title='изменить название альбома'>
								<div class='image2'></div>
							</div>
							
							<!--удаление альбома-->
							<div id='del".$row['id']."' onclick='delete".$row['id']."()' class='delete_alb' title='удалить альбом'>
								<div class='image3'></div>
								
								<!--форма для удаления альбома-->
								<form id='form_del".$row['id']."' method='post' action='album_delete.php' class='form_delete'>
									Ты точно хочешь удалить<br><b>".$row['albums']."</b>?<br>
									<input type='hidden' name='delete' value='".$row['albums']."'>
									<input type='submit' value='удалить альбом' class='delete_butt'>
								</form>
							</div>
					</div>
				";
				//подключаем из бд фотографии
				echo "
				<div class='show_foto'>
					";
					$q_foto="SELECT * FROM `foto` WHERE `album`='".$row['albums']."'";
					$res_foto=mysql_query($q_foto);
					while($row_foto=mysql_fetch_array($res_foto)){
						echo "
						<div class='block_imgs'>
							<img src='foto_all/".$row_foto['foto_small']."' class='imgs'>
						</div>
						";
					}
					echo "
				</div>
		</li>
		";
		//пишем скрипт для строки
		echo "
		<script>
			//открыть-закрыть фотографии
			var li".$row['id']." = document.getElementById('li".$row['id']."');//ячейка списка
			var hide".$row['id']." = document.getElementById('hide".$row['id']."');//кнопка скрыть
			var show".$row['id']." = document.getElementById('show".$row['id']."');//кнопка раскрыть
			
			//открываем
			function showHide".$row['id']."(){
				li".$row['id'].".style.cssText = 'height: auto;';
				hide".$row['id'].".style.display = 'none';
				show".$row['id'].".style.display = 'block';
			}
			//закрываем
			function showHide1".$row['id']."(){
				li".$row['id'].".style.cssText = 'height: 80px;';
				hide".$row['id'].".style.display = 'block';
				show".$row['id'].".style.display = 'none';
			}
			
			//редактируем название альбома
			var ch".$row['id']." = document.getElementById('ch".$row['id']."');//кнопка
			var form".$row['id']." = document.getElementById('form".$row['id']."');//форма
			var h1".$row['id']." = document.getElementById('h1".$row['id']."');//заголовок
			
			//редактируем
			function change".$row['id']."(){
				form".$row['id'].".style.cssText = 'display: block;';
				back_click.style.cssText = 'display: block';
				h1".$row['id'].".style.cssText = 'opacity: 0';
				back_click.onclick = function(){//нажимаем на бэк и все возвращается
				back_click.style.cssText = 'display: none;';
				form".$row['id'].".style.cssText = 'display: none;';
				h1".$row['id'].".style.cssText = 'opacity: 1';
				}
			}
			
			//удаляем альбом
			var form_del".$row['id']." = document.getElementById('form_del".$row['id']."');
			
			function delete".$row['id']."(){
				form_del".$row['id'].".style.cssText = 'display: block';
				back_click.style.cssText = 'display: block';
				back_click.onclick = function(){//нажимаем на бэк и все возвращается
					back_click.style.cssText = 'display: none;';
					form_del".$row['id'].".style.cssText = 'display: none;';
				}
			}
		</script>
		<hr>
		";
}
?>
</ul>