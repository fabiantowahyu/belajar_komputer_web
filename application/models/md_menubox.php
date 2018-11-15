<?php
class Md_menubox extends CI_Model {

	// Fungsi Ambil Data Menu
	public function MDL_ListSubMenu($userid) {
		$tblmenu 			= $this->config->item('tmst_menu');
		$tbluser 			= $this->config->item('tmst_users');
		$tbluser_group 		= $this->config->item('tmst_users_group');
		$tblgroup			= $this->config->item('tmst_group');
		$tblgroup_detail	= $this->config->item('tmst_group_det');

		$hasil = array();
		
		$sSQL = "
			SELECT m.id,m.custom_title,m.parent_id,m.url_menu, m.path_icon
			FROM $tblmenu m, (
				SELECT g.id,gd.menu_id
				FROM $tblgroup g, $tblgroup_detail gd
				WHERE gd.pid = g.id
			) grp , (
				SELECT ug.user_id, ug.group_id
				FROM $tbluser u, $tbluser_group ug
				WHERE ug.user_id = u.emp_id
			) usr
			WHERE grp.menu_id = m.id
				AND usr.group_id = grp.id
				AND usr.user_id = '$userid'
				AND m.active = 1
			ORDER BY parent_id,tid
		";

		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			foreach ($ambil->result() as $data) {
				$hasil[] = $data;
			}	
		}

		return $hasil;
	}

	//Deklarasi MenuBox
	public function MDL_content_menubox($userid) {
		$AryData = $this->MDL_ListSubMenu($userid);

		if(count($AryData)) {
			$aryL = array();
			$aryTMP = array();
			$rows = array();
			$aX = array();
			$tmp = "";
			foreach($AryData as $row2) {
				if(isset($aryL[$row2->parent_id])) {
					$aryL[$row2->id] = $aryL[$row2->parent_id]."-".$row2->parent_id;
				} else {
					$aryL[$row2->id] = $row2->parent_id;
				}
				$x = @explode("-",$aryL[$row2->id]);
				$tmp .= "\$aX['".join("']['sub']['",$x)."']['sub']['".$row2->id."']['id'] = '".$row2->id."';\n";
				$tmp .= "\$aX['".join("']['sub']['",$x)."']['sub']['".$row2->id."']['title'] = '".addslashes($row2->custom_title)."';\n";
				$tmp .= "\$aX['".join("']['sub']['",$x)."']['sub']['".$row2->id."']['url_menu'] = '".addslashes($row2->url_menu)."';\n";
				//$rows[$k]['sub'] = $parent[$k];

				if(strlen($row2->parent_id)) {
					$aryTMP[$row2->id] = $row2;
				}

			}

			@reset($aryL);
			foreach($aryTMP as $rowTMP) {
				if(isset($aryL[$rowTMP->parent_id])) {
					$aryL[$rowTMP->id] = $aryL[$rowTMP->parent_id]."-".$rowTMP->parent_id;
					$x = @explode("-",$aryL[$rowTMP->id]);
					$tmp .= "\$aX['".join("']['sub']['",$x)."']['sub']['".$rowTMP->id."']['id'] = '".$rowTMP->id."';\n";
					$tmp .= "\$aX['".join("']['sub']['",$x)."']['sub']['".$rowTMP->id."']['title'] = '".addslashes($rowTMP->custom_title)."';\n";
					$tmp .= "\$aX['".join("']['sub']['",$x)."']['sub']['".$rowTMP->id."']['url_menu'] = '".addslashes($rowTMP->url_menu)."';\n";

				}
			}

			eval($tmp);
			$rows = $aX['']['sub'];
			if($this->router->fetch_class()=="change_themes") {
				$parram[1] = "20130719044206016906";
			} else {
				$pp = $this->MDL_getMenuActive($this->router->fetch_class());
				$parram = @explode("-",$aryL[$pp]);
			}

			$content = $this->MDL_content_addList('KC',$rows,'0',@$parram[1]);
		
			return $content;
		}
	}

	public function MDL_content_addList($name,$arymenu,$step=0,$parram='') {
		@reset($arymenu);

		if(is_array($arymenu) && count($arymenu)) {
			$step += 1;
			$content = '';
			if($step > 1) {
				$content .= str_repeat("\t",$step) . "<ul>\n";
			}
			$i=0;

			while(list($k,$v) = @each($arymenu)) {

				if(isset($v['sub'])) {
					//$title = "&nbsp;&nbsp; ".$v['title']." &nbsp;&nbsp;";
					$title = $v['title'];
				} else {
					$title = $v['title'];
				}
				
				
				if($k==$parram) {
					$content .= str_repeat("\t",$step + 1) . "<li class='has-sub active'>"; #** name=\"".$v['name']."\"
				} else {
					$content .= str_repeat("\t",$step + 1) . "<li class='has-sub'>"; #** name=\"".$v['name']."\"
				}

				$url_menu = ($v['url_menu']=="#") ? $v['url_menu'] : sprintf("%s%s",site_url(),$v['url_menu']);
				if(isset($v['sub'])) {
					//$content .= "<a href=\"".$url_menu."\" style=\"text-align:left;\" class='topmenu'>". $title . "</a>";
					$content .= "<a href=\"".$url_menu."\" class='nav_sub_arrow'>". $title . "</a>";
					$content .= "\n";
					$content .= $this->MDL_content_addList($v['title'],$v['sub'],$step + 1);
					$content .= str_repeat("\t",$step + 1);
					
				} else {
					$content .= "<a href=\"".$url_menu."\" >". $title . "</a>";
				}
				$content .= "</li>\n";
				
			}
			$i++;
			if($step > 1) {
				$content .= str_repeat("\t",$step) . "</ul>\n";
			}
		}
		return $content;
	}
	
	//MENU DENGAN ICON
	//Deklarasi MenuBox
	public function MDL_MainMenu($userid) {
		$AryData = $this->MDL_ListSubMenu($userid);

		if(count($AryData)) {
			$aryTMP = array();
			$aryL = array();
			$rows = array();
			$aX = array();
			$tmp = "";
			foreach($AryData as $row2) {
				if(isset($aryL[$row2->parent_id])) {
					$aryL[$row2->id] = $aryL[$row2->parent_id]."-".$row2->parent_id;
				} else {
					$aryL[$row2->id] = $row2->parent_id;
				}
				$x = @explode("-",$aryL[$row2->id]);
				$tmp .= "\$aX['".join("']['sub']['",$x)."']['sub']['".$row2->id."']['id'] = '".$row2->id."';\n";
				$tmp .= "\$aX['".join("']['sub']['",$x)."']['sub']['".$row2->id."']['title'] = '".addslashes($row2->custom_title)."';\n";
				$tmp .= "\$aX['".join("']['sub']['",$x)."']['sub']['".$row2->id."']['url_menu'] = '".addslashes($row2->url_menu)."';\n";
				$tmp .= "\$aX['".join("']['sub']['",$x)."']['sub']['".$row2->id."']['path_icon'] = '".addslashes($row2->path_icon)."';\n";
				//$rows[$k]['sub'] = $parent[$k];

				if(strlen($row2->parent_id)) {
					$aryTMP[$row2->id] = $row2;
				}

			}

			@reset($aryL);
			foreach($aryTMP as $rowTMP) {
				if(isset($aryL[$rowTMP->parent_id])) {
					$aryL[$rowTMP->id] = $aryL[$rowTMP->parent_id]."-".$rowTMP->parent_id;
					$x = @explode("-",$aryL[$rowTMP->id]);
					$tmp .= "\$aX['".join("']['sub']['",$x)."']['sub']['".$rowTMP->id."']['id'] = '".$rowTMP->id."';\n";
					$tmp .= "\$aX['".join("']['sub']['",$x)."']['sub']['".$rowTMP->id."']['title'] = '".addslashes($rowTMP->custom_title)."';\n";
					$tmp .= "\$aX['".join("']['sub']['",$x)."']['sub']['".$rowTMP->id."']['url_menu'] = '".addslashes($rowTMP->url_menu)."';\n";
					$tmp .= "\$aX['".join("']['sub']['",$x)."']['sub']['".$rowTMP->id."']['path_icon'] = '".addslashes($rowTMP->path_icon)."';\n";

				}
			}

			eval($tmp);
			$rows = $aX['']['sub'];
			$pp = $this->MDL_getMenuActive($this->router->fetch_class());
			$topmenu = @explode("-",$aryL[$pp]);
			$parram['topmenu'] = @$topmenu[1];
			
			//for multilevel sub menu
			if(isset($topmenu[2])){
				$parram['topmenu1'] = $topmenu[2];
			}

			$parram['active'] = $pp;

			$content = $this->MDL_MainMenu_List('KC',$rows,0,$parram);
		
			return $content;
		}
	}

	public function MDL_MainMenu_List($name,$arymenu,$step=0,$parram=array()) {
		@reset($arymenu);

		if(is_array($arymenu) && count($arymenu)) {
			$step += 1;
			$content = '';
			if($step > 1) {
				$content .= str_repeat("\t",$step) . "<ul class=\"submenu\">\n";
			}
			$i=0;

			while(list($k,$v) = @each($arymenu)) {
				$title = $v['title'];

				//for multilevel sub menu
				if(isset($parram['topmenu1'])){
					$parram['topmenu1'] = $parram['topmenu1'];
				}else{
					$parram['topmenu1'] = NULL;
				}

				/* Original, Modified By Danang
				if($k == $parram['topmenu']) {
					$content .= str_repeat("\t",$step + 1) . "<li class='active open'>";
				} elseif($v['id'] == $parram['active']) {
					$content .= str_repeat("\t",$step + 1) . "<li class='active'>";
				} else {
					$content .= str_repeat("\t",$step + 1) . "<li>";
				}*/
				
				if($k == $parram['topmenu']) {
					$content .= str_repeat("\t",$step + 1) . "<li class='active open'>";
				}elseif($k == $parram['topmenu1']) { //for multilevel sub menu
					$content .= str_repeat("\t",$step + 2) . "<li class='active open'>";
				} elseif($v['id'] == $parram['active']) {
					$content .= str_repeat("\t",$step + 1) . "<li class='active'>";
				} else {
					$content .= str_repeat("\t",$step + 1) . "<li>";
				}

				$url_menu = ($v['url_menu']=="#") ? $v['url_menu'] : sprintf("%s%s",site_url(),$v['url_menu']);
				$icon = strlen($v['path_icon']) ? $v['path_icon'] : "icon-double-angle-right";
				if(isset($v['sub'])) {
					if($step > 1) {
						$content .= "
							<a href=\"".$url_menu."\" class=\"dropdown-toggle\">
								<i class=\"".$icon."\"></i>
								<span class=\"menu-text\">" . $title . "</span>
								<b class=\"arrow icon-angle-down\"></b>
							</a>";
					} else {
						$content .= "
							<a href=\"".$url_menu."\" class=\"dropdown-toggle\">
								<i class=\"".$icon."\"></i>
								<span class=\"menu-text\">" . $title . "</span>
								<b class=\"arrow icon-angle-down\"></b>
							</a>";
					}
					$content .= "\n";
					$content .= $this->MDL_MainMenu_List($v['title'],$v['sub'],$step + 1,$parram);
					$content .= str_repeat("\t",$step + 1);
					
				} else {
					$content .= "
						<a href=\"".$url_menu."\" >
							<i class=\"".$icon."\"></i>
							<span class=\"menu-text\">" . $title . "</span>
						</a>";
				}
				$content .= "</li>\n";
				
			}
			$i++;
			if($step > 1) {
				$content .= str_repeat("\t",$step) . "</ul>\n";
			}
		}
		return $content;
	}

	public function MDL_getMenuActive($parram) {
		$tblmenu = $this->config->item('tmst_menu');

		$hasil = "";
		$sSQL = "
			SELECT m.parent_id,m.custom_title
			FROM $tblmenu m1
				LEFT JOIN $tblmenu m ON m.id = m1.parent_id
			WHERE 1=1
				AND m1.url_menu LIKE '$parram%'
				AND m1.active = 1
		";
		
		$sSQL = "
			SELECT id
			FROM $tblmenu
			WHERE 1=1
				AND (url_menu LIKE '$parram' OR url_menu LIKE '$parram/')
				AND active = 1
		";

		$ambil = $this->db->query($sSQL);
		if ($ambil->num_rows() > 0) {
			foreach ($ambil->result() as $data) {
				$hasil = $data->id;
			}	
		}

		return $hasil;
	}

	public function MDL_getAvatar_User(){
		$tblemployee = $this->config->item('tmst_employee');

		$id = $this->session->userdata('userid');
		$hasil = $this->db->get_where($tblemployee, array('emp_id' => $id))->row();
		$file_name = @$hasil->photo;
		if(strlen($file_name)) {
			$ary = @explode(".",$file_name);
			$type = $ary[count($ary)-1];
			$filename = sprintf("file_upload/avatar/%s.%s",$id,$type);
			//var_dump($filename); exit();
		} else {
			$filename = sprintf("file_upload/avatar/no_photo.jpg");
		}
		
        return $filename;
    }
	
}
?>