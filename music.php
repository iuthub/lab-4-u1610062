<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Music Viewer</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="viewer.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div id="header">

			<h1>190M Music Playlist Viewer</h1>
			<h2>Search Through Your Playlists and Music</h2>
		</div>


		<div id="listarea">
			<ul id="musiclist">

				<?php 
				if(isset($_REQUEST["playlist"]))
				$playlist=$_REQUEST["playlist"];
				if(!isset($playlist))
				{
				$songs=glob("songs/*.mp3");
				$playlists=glob("songs/*.txt");
				foreach ($songs as $songsfile) {
				?>
				<li class="mp3item"><a href="songs/<?= basename($songsfile); ?>">

					<?php
					if(filesize($songsfile)>0&&filesize($songsfile)<=1023){
					 echo basename($songsfile) ."\t\t(".  filesize($songsfile) ."b)";
					}
					else 
						if(filesize($songsfile)>1023&&filesize($songsfile)<=1048575){
								 echo basename($songsfile) ."\t\t(".  round(filesize($songsfile)/1024,2) ."kb)";
						}
						else
						if(filesize($songsfile)>1048575){
								 echo basename($songsfile) ."\t\t(". round( filesize($songsfile)/1048576,2) ."mb)";
						}
					?>
				</a>
				</li>
				<?php 
			}
			?>
			<?php 
			foreach ($playlists as $playlistfile) {
			?>
			<li class="playlistitem"><a href="songs/<?= basename($playlistfile); ?>">
					<?= basename($playlistfile);?>
				</a>
				</li>
				<?php
			}
		}else
		{
			if(@fopen("songs/$playlist","r") OR die("Could not find $playlist!"))
			{
			foreach (file("songs/$playlist") as $songsfile) {
		?>
		<li class="mp3item"><a href="songs/<?= basename($songsfile); ?>">
					<?= basename($songsfile);?>
				</a>
				</li>
			<?php
		
		}
		}
	}
		
		?>
			</ul>
		</div>
	</body>
</html>
