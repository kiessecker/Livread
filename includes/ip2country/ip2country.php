<?php
/*********************************************************

* DO NOT REMOVE *

Project: PHPWeby ip2country software version 1.0.2
Url: http://phpweby.com/
Copyright: (C) 2008 Blagoj Janevski - bl@blagoj.com
Project Manager: Blagoj Janevski

More info, sample code and code implementation can be found here:
http://phpweby.com/software/ip2country

This software uses GeoLite data created by MaxMind, available from
http://maxmind.com

This file is part of i2pcountry module for PHP.

For help, comments, feedback, discussion ... please join our
Webmaster forums - http://forums.phpweby.com

**************************************************************************
*  If you like this software please link to us!                          *
*  Use this code:						         *
*  <a href="http://phpweby.com/software/ip2country">ip to country</a>    *
*  More info can be found at http://phpweby.com/link                     *
**************************************************************************

License:
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License along
with this program; if not, write to the Free Software Foundation, Inc.,
51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.

*********************************************************/

class ip2country {

	public $table_name='ip2c';
	private $ip_num=0;
	private $ip='';
	private $country_code='';
	private $country_name='';
	private $con=false;

	function ip2country()
	{
		$this->set_ip();
	}

	public function get_ip_num()
	{
		return $this->ip_num;
	}
	public function set_ip($newip='')
	{
		if($newip=='')
		$newip=$this->get_client_ip();

		$this->ip=$newip;
		$this->calculate_ip_num();
		$this->country_code='';
		$this->country_name='';
	}
	public function calculate_ip_num()
	{
		if($this->ip=='')
		$this->ip=$this->get_client_ip();

		$this->ip_num=sprintf("%u",ip2long($this->ip));
	}
	public function get_country_code($ip_addr='')
	{
		if($ip_addr!='' && $ip_addr!=$this->ip)
		$this->set_ip($ip_addr);

		if($ip_addr=='')
		{
			if($this->ip!=$this->get_client_ip())
			$this->set_ip();
		}

		if($this->country_code!='')
		return $this->country_code;

		$sq="SELECT country_code,country_name FROM ".$this->table_name. " WHERE ". $this->ip_num." BETWEEN begin_ip_num AND end_ip_num";
		$r=@mysql_query($sq);

		if(!$r)
		return '';

		$row=@mysql_fetch_assoc($r);
		$this->country_name=$row['country_name'];
		$this->country_code=$row['country_code'];
		return $row['country_code'];
	}

	public function get_country_name($ip_addr='')
	{
		$this->get_country_code($ip_addr);
		return $this->country_name;
	}

	public function get_client_ip()
	{
		$v='';
		$v= (!empty($_SERVER['REMOTE_ADDR']))?$_SERVER['REMOTE_ADDR'] :((!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) ? $_SERVER['HTTP_X_FORWARDED_FOR']: @getenv('REMOTE_ADDR'));
		if(isset($_SERVER['HTTP_CLIENT_IP']))
		$v=$_SERVER['HTTP_CLIENT_IP'];
		return htmlspecialchars($v,ENT_QUOTES);
	}

}
?>
