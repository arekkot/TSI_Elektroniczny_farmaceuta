<?php require_once APPPATH . 'views/site/include/header.php'; ?>

<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">

<h1>Twoje konto</h1>
<hr>

			<div class="row">
				<div class="col-sm-4 col-md-4">

<?php echo form_open(); ?>

<div class="form-group">
	<label for="name">Imię</label>
	<input id="name" class="form-control" type="text" name="name" placeholder="Imię" value="<?php echo $user->name; ?>">
</div>

<div class="form-group">
	<label for="email">Email</label>
	<input id="email" class="form-control" type="text" name="email" placeholder="Email" value="<?php echo $user->email; ?>" disabled>
</div>

<div class="form-group">
	<label for="password">Hasło</label>
	<input id="password" class="form-control" type="password" name="password" placeholder="Nowe hasło">
</div>

<div class="form-group">
	<label for="passconf">Powtórz nowe hasło</label>
	<input id="passconf" class="form-control" type="password" name="passconf" placeholder="Powtórz nowe hasło">
</div>

<hr>

<div class="form-group">
	<label for="address">Adres</label>
	<input id="address" class="form-control" type="text" name="address" placeholder="Adres" value="<?php echo $user->address; ?>">
</div>

<div class="form-group">
	<label for="zip_code">Kod pocztowy</label>
	<input id="zip_code" class="form-control" type="text" name="zip_code" placeholder="Kod pocztowy" value="<?php echo $user->zip_code; ?>">
</div>

<div class="form-group">
	<label for="city">Miasto</label>
	<input id="city" class="form-control" type="text" name="city" placeholder="Miasto" value="<?php echo $user->city; ?>">
</div>

<?php
$lista_panstw = array(
"1"=>"Abchazja",
"2"=>"Afganistan",
"3"=>"Albania",
"4"=>"Algieria",
"5"=>"Andora",
"6"=>"Angola",
"7"=>"Antigua i Barbuda",
"8"=>"Arabia Saudyjska",
"9"=>"Argentyna",
"10"=>"Armenia",
"11"=>"Australia",
"12"=>"Austria",
"13"=>"Azerbejdżan",
"14"=>"Bahamy",
"15"=>"Bahrajn",
"16"=>"Bangladesz",
"17"=>"Barbados",
"18"=>"Belgia",
"19"=>"Belize",
"20"=>"Benin",
"21"=>"Bhutan",
"22"=>"Białoruś",
"23"=>"Birma",
"24"=>"Boliwia",
"25"=>"Bośnia i Hercegowina",
"26"=>"Botswana",
"27"=>"Brazylia",
"28"=>"Brunei",
"29"=>"Bułgaria",
"30"=>"Burkina Faso",
"31"=>"Burundi",
"32"=>"Chile",
"33"=>"Chiny",
"34"=>"Chorwacja",
"35"=>"Cypr",
"36"=>"Cypr Północny",
"37"=>"Czad",
"38"=>"Czarnogóra",
"39"=>"Czechy",
"40"=>"Dania",
"41"=>"Demokratyczna Republika Konga",
"42"=>"Dominika",
"43"=>"Dominikana",
"44"=>"Dżibuti",
"45"=>"Egipt",
"46"=>"Ekwador",
"47"=>"Erytrea",
"48"=>"Estonia",
"49"=>"Etiopia",
"50"=>"Fidżi",
"51"=>"Filipiny",
"52"=>"Finlandia",
"53"=>"Francja",
"54"=>"Gabon",
"55"=>"Gambia",
"56"=>"Ghana",
"57"=>"Górski Karabach",
"58"=>"Grecja",
"59"=>"Grenada",
"60"=>"Gruzja",
"61"=>"Gujana",
"62"=>"Gwatemala",
"63"=>"Gwinea",
"64"=>"Gwinea Bissau",
"65"=>"Gwinea Równikowa",
"66"=>"Haiti",
"67"=>"Hiszpania",
"68"=>"Holandia",
"69"=>"Honduras",
"70"=>"Indie",
"71"=>"Indonezja",
"72"=>"Irak",
"73"=>"Iran",
"74"=>"Irlandia",
"75"=>"Islandia",
"76"=>"Izrael",
"77"=>"Jamajka",
"78"=>"Japonia",
"79"=>"Jemen",
"80"=>"Jordania",
"81"=>"Kambodża",
"82"=>"Kamerun",
"83"=>"Kanada",
"84"=>"Katar",
"85"=>"Kazachstan",
"86"=>"Kenia",
"87"=>"Kirgistan",
"88"=>"Kiribati",
"89"=>"Kolumbia",
"90"=>"Komory",
"91"=>"Kongo",
"92"=>"Korea Południowa",
"93"=>"Korea Północna",
"94"=>"Kosowo",
"95"=>"Kostaryka",
"96"=>"Kuba",
"97"=>"Kuwejt",
"98"=>"Laos",
"99"=>"Lesotho",
"100"=>"Liban",
"101"=>"Liberia",
"102"=>"Libia",
"103"=>"Liechtenstein",
"104"=>"Litwa",
"105"=>"Luksemburg",
"106"=>"Łotwa",
"107"=>"Macedonia",
"108"=>"Madagaskar",
"109"=>"Malawi",
"110"=>"Malediwy",
"111"=>"Malezja",
"112"=>"Mali",
"113"=>"Malta",
"114"=>"Maroko",
"115"=>"Mauretania",
"116"=>"Mauritius",
"117"=>"Meksyk",
"118"=>"Mikronezja",
"119"=>"Mołdawia",
"120"=>"Monako",
"121"=>"Mongolia",
"122"=>"Mozambik",
"123"=>"Naddniestrze",
"124"=>"Namibia",
"125"=>"Nauru",
"126"=>"Nepal",
"127"=>"Niemcy",
"128"=>"Niger",
"129"=>"Nigeria",
"130"=>"Nikaragua",
"131"=>"Norwegia",
"132"=>"Nowa Zelandia",
"133"=>"Oman",
"134"=>"Osetia Południowa",
"135"=>"Pakistan",
"136"=>"Panama",
"137"=>"Papua - Nowa Gwinea",
"138"=>"Paragwaj",
"139"=>"Peru",
"140"=>"Polska",
"141"=>"Portugalia",
"142"=>"Republika Południowej Afryki",
"143"=>"Republika Środkowoafrykańska",
"144"=>"Republika Zielonego Przylądka",
"145"=>"Rosja",
"146"=>"Rumunia",
"147"=>"Rwanda",
"148"=>"Saint Kitts i Nevis",
"149"=>"Saint Lucia",
"150"=>"Saint Vincent i Grenadyny",
"151"=>"Salwador",
"152"=>"Samoa",
"153"=>"San Marino",
"154"=>"Senegal",
"155"=>"Serbia",
"156"=>"Seszele",
"157"=>"Sierra Leone",
"158"=>"Singapur",
"159"=>"Słowacja",
"160"=>"Słowenia",
"161"=>"Somalia",
"162"=>"Somaliland",
"163"=>"Sri Lanka",
"164"=>"Stany Zjednoczone",
"165"=>"Suazi",
"166"=>"Sudan",
"167"=>"Surinam",
"168"=>"Syria",
"169"=>"Szwajcaria",
"170"=>"Szwecja",
"171"=>"Tadżykistan",
"172"=>"Tajlandia",
"173"=>"Tajwan",
"174"=>"Tanzania",
"175"=>"Timor Wschodni",
"176"=>"Togo",
"177"=>"Tonga",
"178"=>"Trynidad i Tobago",
"179"=>"Tunezja",
"180"=>"Turcja",
"181"=>"Turkmenistan",
"182"=>"Tuvalu",
"183"=>"Uganda",
"184"=>"Ukraina",
"185"=>"Urugwaj",
"186"=>"Uzbekistan",
"187"=>"Vanuatu",
"188"=>"Watykan",
"189"=>"Wenezuela",
"190"=>"Węgry",
"191"=>"Wielka Brytania",
"192"=>"Wietnam",
"193"=>"Włochy",
"194"=>"Wybrzeże Kości Słoniowej",
"195"=>"Wyspy Salomona",
"196"=>"Wyspy Świętego Tomasza i Książęca",
"197"=>"Zambia",
"198"=>"Zimbabwe",
"199"=>"Zjednoczone Emiraty Arabskie"
);

?>
<div class="form-group">
	<label for="country">Państwo</label>

	<select id="country" name="country" class="form-control">
		<?php foreach ( $lista_panstw as $panstwo ): ?>

			<?php if ( !empty( $user->country ) ): ?>

				<?php if ( $user->country == $panstwo ): ?>
					<option value="<?php echo $panstwo; ?>" selected><?php echo $panstwo; ?></option>
				<?php else: ?>
					<option value="<?php echo $panstwo; ?>"><?php echo $panstwo; ?></option>
				<?php endif; ?>

			<?php else: ?>

				<?php if ( $panstwo == 'Polska' ): ?>
					<option value="<?php echo $panstwo; ?>" selected><?php echo $panstwo; ?></option>
				<?php else: ?>
					<option value="<?php echo $panstwo; ?>"><?php echo $panstwo; ?></option>
				<?php endif ?>

			<?php endif; ?>

		<?php endforeach; ?>
	</select>
</div>

<div class="form-group">
	<label for="phone">Nr telefonu</label>
	<input id="phone" class="form-control" type="text" name="phone" placeholder="Nr telefonu" value="<?php echo $user->phone; ?>">
</div>

<button type="submit" class="btn btn-primary btn-lg btn-block">Zapisz</button>

<?php echo form_close(); ?>

<p>&nbsp;</p>

				</div>
			</div>

		</div>
	</div>
</div>

<footer>
  <div class="container-fluid">
    <div class="col-md-12">
      <p class="footer-text">Elektroniczny Farmaceuta:</p>
      <p class="footer-last">tel: 663698144</p>
    </div>
  </div>
</footer>

<?php require_once APPPATH . 'views/site/include/footer.php'; ?>
</body>
</html>
