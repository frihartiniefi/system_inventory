<div class="col-md-3 p-3 mt-5 profile-holder slide-in-left">
	<div class="holder-top">
		<h5>Welcome,</h5>
		<p><?= $this->session->userdata('nama'); ?></p>
	</div>

	<div class="holder-middle">
		<ul>
			<p>NIP</p>
			<li><span><?= $this->session->userdata('nip'); ?></span></li>
		</ul>
		<ul>
			<p>Nama Lengkap</p>
			<li><span><?= $this->session->userdata('nama'); ?></span></li>
		</ul>
		<ul>
			<p>Status Kepegawaian</p>
			<li><span><?= $this->session->userdata('status_pegawai'); ?></span></li>
		</ul>
		<ul>
			<p>Unit Kerja</p>
			<li><span><?= empty($this->session->userdata('unit_kerja'))?'-':$this->session->userdata('unit_kerja'); ?></span></li>
		</ul>
		<ul>
			<p>Subdirektorat/Sub-bagian</p>
			<li><span><?= empty($this->session->userdata('subbagian'))?'-':$this->session->userdata('subbagian'); ?></span></li>
		</ul>
		<ul>
			<p>Jabatan</p>
			<li><span><?= $this->session->userdata('jabatan'); ?></span></li>
		</ul>
		<ul>
			<p>No. Hp Aktif</p>
			<li><span><?= $this->session->userdata('no_telp'); ?></span></li>
		</ul>
		<ul>
			<p>Alamat Email Aktif</p>
			<li><span><?= $this->session->userdata('email'); ?></span></li>
		</ul>
	</div>
</div>