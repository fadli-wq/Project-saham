<?php

namespace Database\Seeders;

use App\Models\Emiten;
use Illuminate\Database\Seeder;

class EmitenGelombang5Seeder extends Seeder
{
    public function run(): void
    {
        $emitens = [
            // A
            ['kode'=>'ABDA','nama'=>'Asuransi Bina Dana Arta','sector_id'=>1],
            ['kode'=>'ABMM','nama'=>'ABM Investama','sector_id'=>7],
            ['kode'=>'ADCP','nama'=>'Adhi Commuter Properti','sector_id'=>6],
            ['kode'=>'ADMF','nama'=>'Adira Dinamika Multi Finance','sector_id'=>1],
            ['kode'=>'AGAR','nama'=>'Asia Sejahtera Mina','sector_id'=>3],
            ['kode'=>'AGRO','nama'=>'Bank Raya Indonesia','sector_id'=>1],
            ['kode'=>'AHAW','nama'=>'Asuransi Harta Aman Pratama','sector_id'=>1],
            ['kode'=>'AHAP','nama'=>'Asuransi Harta Aman Pratama','sector_id'=>1],
            ['kode'=>'AIMS','nama'=>'Akbar Indo Makmur Stimec','sector_id'=>3],
            ['kode'=>'AKKU','nama'=>'Anugerah Kagum Karya Utama','sector_id'=>3],
            ['kode'=>'AKPI','nama'=>'Argha Karya Prima Industry','sector_id'=>10],
            ['kode'=>'ALKA','nama'=>'Alakasa Industrindo','sector_id'=>10],
            ['kode'=>'ALTO','nama'=>'Tri Banyan Tirta','sector_id'=>3],
            ['kode'=>'AMAG','nama'=>'Asuransi Multi Artha Guna','sector_id'=>1],
            ['kode'=>'AMIN','nama'=>'Ateliers Mecaniques D Indonesie','sector_id'=>10],
            ['kode'=>'ANDI','nama'=>'Andira Agro','sector_id'=>3],
            ['kode'=>'ANJT','nama'=>'Austindo Nusantara Jaya','sector_id'=>3],
            ['kode'=>'APIC','nama'=>'Pacific Strategic Financial','sector_id'=>1],
            ['kode'=>'APII','nama'=>'Arita Prima Indonesia','sector_id'=>10],
            ['kode'=>'APLI','nama'=>'Asiaplast Industries','sector_id'=>10],
            ['kode'=>'ARKA','nama'=>'Arkha Jayanti Persada','sector_id'=>10],
            ['kode'=>'ARMY','nama'=>'Armidian Karyatama','sector_id'=>6],
            ['kode'=>'ARTA','nama'=>'Arthavest','sector_id'=>1],
            ['kode'=>'ARTI','nama'=>'Ratu Prabu Energi','sector_id'=>7],
            ['kode'=>'ASBI','nama'=>'Asuransi Bintang','sector_id'=>1],
            ['kode'=>'ASDM','nama'=>'Asuransi Dayin Mitra','sector_id'=>1],
            ['kode'=>'ASGR','nama'=>'Astra Graphia','sector_id'=>5],
            ['kode'=>'ASJT','nama'=>'Asuransi Jasa Tania','sector_id'=>1],
            ['kode'=>'ASMI','nama'=>'Asuransi Kresna Mitra','sector_id'=>1],
            ['kode'=>'ASPI','nama'=>'Andalan Sakti Primaindo','sector_id'=>6],
            ['kode'=>'ASRM','nama'=>'Asuransi Ramayana','sector_id'=>1],
            ['kode'=>'ATIC','nama'=>'Anabatic Technologies','sector_id'=>5],
            ['kode'=>'AYLS','nama'=>'Agro Yasa Lestari','sector_id'=>3],
            
            // B
            ['kode'=>'BACA','nama'=>'Bank Capital Indonesia','sector_id'=>1],
            ['kode'=>'BAPI','nama'=>'Bhakti Agung Propertindo','sector_id'=>6],
            ['kode'=>'BBLD','nama'=>'Buana Finance','sector_id'=>1],
            ['kode'=>'BBRM','nama'=>'Pelayaran Nasional Bina Buana Raya','sector_id'=>12],
            ['kode'=>'BBYB','nama'=>'Bank Neo Commerce','sector_id'=>1],
            ['kode'=>'BCAP','nama'=>'MNC Kapital Indonesia','sector_id'=>1],
            ['kode'=>'BDMN','nama'=>'Bank Danamon Indonesia','sector_id'=>1],
            ['kode'=>'BEEF','nama'=>'Estika Tata Tiara','sector_id'=>3],
            ['kode'=>'BEKS','nama'=>'Bank Pembangunan Daerah Banten','sector_id'=>1],
            ['kode'=>'BELL','nama'=>'Trisula Textile Industries','sector_id'=>10],
            ['kode'=>'BESS','nama'=>'Batulicin Nusantara Maritim','sector_id'=>12],
            ['kode'=>'BIMA','nama'=>'Primarindo Asia Infrastructure','sector_id'=>10],
            ['kode'=>'BINA','nama'=>'Bank Ina Perdana','sector_id'=>1],
            ['kode'=>'BIPI','nama'=>'Astrindo Nusantara Infrastruktur','sector_id'=>7],
            ['kode'=>'BJBR','nama'=>'Bank Pembangunan Daerah Jawa Barat dan Banten','sector_id'=>1],
            ['kode'=>'BJTM','nama'=>'Bank Pembangunan Daerah Jawa Timur','sector_id'=>1],
            ['kode'=>'BKSL','nama'=>'Sentul City','sector_id'=>6],
            ['kode'=>'BLTA','nama'=>'Berlian Laju Tanker','sector_id'=>12],
            ['kode'=>'BLTZ','nama'=>'Graha Layar Prima','sector_id'=>11],
            ['kode'=>'BLUE','nama'=>'Berkah Prima Perkasa','sector_id'=>10],
            ['kode'=>'BMSR','nama'=>'Bintang Mitra Semestaraya','sector_id'=>10],
            ['kode'=>'BNBR','nama'=>'Bakrie & Brothers','sector_id'=>8],
            ['kode'=>'BNGA','nama'=>'Bank CIMB Niaga','sector_id'=>1],
            ['kode'=>'BNII','nama'=>'Bank Maybank Indonesia','sector_id'=>1],
            ['kode'=>'BNLI','nama'=>'Bank Permata','sector_id'=>1],
            ['kode'=>'BOSS','nama'=>'Borneo Olak Karya Sukses','sector_id'=>4],
            ['kode'=>'BPTR','nama'=>'Batavia Prosperindo Trans','sector_id'=>12],
            ['kode'=>'BRAM','nama'=>'Indo Kordsa','sector_id'=>10],
            ['kode'=>'BSWD','nama'=>'Bank of India Indonesia','sector_id'=>1],
            ['kode'=>'BTPS','nama'=>'Bank BTPN Syariah','sector_id'=>1],
            ['kode'=>'BUDI','nama'=>'Budi Starch & Sweetener','sector_id'=>3],
            ['kode'=>'BUKK','nama'=>'Bukaka Teknik Utama','sector_id'=>8],
            ['kode'=>'BVIC','nama'=>'Bank Victoria International','sector_id'=>1],
            ['kode'=>'BWPT','nama'=>'Eagle High Plantations','sector_id'=>3],
            
            // C
            ['kode'=>'CAMP','nama'=>'Campina Ice Cream Industry','sector_id'=>3],
            ['kode'=>'CANI','nama'=>'Capitol Nusantara Indonesia','sector_id'=>12],
            ['kode'=>'CARE','nama'=>'Metro Healthcare Indonesia','sector_id'=>9],
            ['kode'=>'CARS','nama'=>'Bintraco Dharma','sector_id'=>10],
            ['kode'=>'CBMF','nama'=>'Cahaya Bintang Medan','sector_id'=>10],
            ['kode'=>'CCSI','nama'=>'Communication Cable Systems Indonesia','sector_id'=>8],
            ['kode'=>'CFIN','nama'=>'Clipan Finance Indonesia','sector_id'=>1],
            ['kode'=>'CINT','nama'=>'Chitose Internasional','sector_id'=>10],
            ['kode'=>'CITY','nama'=>'Natura City Developments','sector_id'=>6],
            ['kode'=>'CLEO','nama'=>'Sariguna Primatirta','sector_id'=>3],
            ['kode'=>'CMNP','nama'=>'Citra Marga Nusaphala Persada','sector_id'=>8],
            ['kode'=>'CNKO','nama'=>'Exploitasi Energi Indonesia','sector_id'=>7],
            ['kode'=>'CNTX','nama'=>'Century Textile Industry','sector_id'=>10],
            ['kode'=>'CPIN','nama'=>'Charoen Pokphand Indonesia','sector_id'=>3],
            ['kode'=>'CSAP','nama'=>'Catur Sentosa Adiprana','sector_id'=>10],
            ['kode'=>'CSIS','nama'=>'Cahayasida Inti Sentosa','sector_id'=>10],
            ['kode'=>'CSMI','nama'=>'Cipta Selera Murni','sector_id'=>3],
            ['kode'=>'CTBN','nama'=>'Citra Tubindo','sector_id'=>10],
            
            // D
            ['kode'=>'DADA','nama'=>'Diamond Citra Propertindo','sector_id'=>6],
            ['kode'=>'DART','nama'=>'Duta Anggada Realty','sector_id'=>6],
            ['kode'=>'DEAL','nama'=>'Dewata Freightinternational','sector_id'=>12],
            ['kode'=>'DEFI','nama'=>'Danasupra Erapacific','sector_id'=>1],
            ['kode'=>'DFAM','nama'=>'Dafam Property Indonesia','sector_id'=>6],
            ['kode'=>'DGIK','nama'=>'Nusa Konstruksi Enjiniring','sector_id'=>8],
            ['kode'=>'DIK','nama'=>'Dinamika Integra Komunika','sector_id'=>5],
            ['kode'=>'DIVA','nama'=>'Distribusi Voucher Nusantara','sector_id'=>5],
            ['kode'=>'DKFT','nama'=>'Central Omega Resources','sector_id'=>4],
            ['kode'=>'DPND','nama'=>'Duta Pertiwi Nusantara','sector_id'=>10],
            ['kode'=>'DPUM','nama'=>'Dua Putra Utama Makmur','sector_id'=>3],
            ['kode'=>'DSFI','nama'=>'Dharma Samudera Fishing Industries','sector_id'=>3],
            ['kode'=>'DWGL','nama'=>'Dwi Guna Laksana','sector_id'=>7],

            // E & F
            ['kode'=>'EAST','nama'=>'Eastparc Hotel','sector_id'=>6],
            ['kode'=>'ECII','nama'=>'Electronic City Indonesia','sector_id'=>10],
            ['kode'=>'EKAD','nama'=>'Ekadharma International','sector_id'=>10],
            ['kode'=>'ELTY','nama'=>'Bakrieland Development','sector_id'=>6],
            ['kode'=>'EMTK','nama'=>'Elang Mahkota Teknologi','sector_id'=>5],
            ['kode'=>'ENZO','nama'=>'Morenzo Abadi Perkasa','sector_id'=>3],
            ['kode'=>'EPMT','nama'=>'Enseval Putera Megatrading','sector_id'=>9],
            ['kode'=>'ERAA','nama'=>'Erajaya Swasembada','sector_id'=>10],
            ['kode'=>'ERTX','nama'=>'Eratex Djaja','sector_id'=>10],
            ['kode'=>'ESTA','nama'=>'Esta Multi Usaha','sector_id'=>6],
            ['kode'=>'ESTI','nama'=>'Ever Shine Tex','sector_id'=>10],
            ['kode'=>'ETWA','nama'=>'Eterindo Wahanatama','sector_id'=>10],
            ['kode'=>'FAST','nama'=>'Fast Food Indonesia','sector_id'=>3],
            ['kode'=>'FASW','nama'=>'Fajar Surya Wisesa','sector_id'=>10],
            ['kode'=>'FILM','nama'=>'MD Pictures','sector_id'=>11],
            ['kode'=>'FIMP','nama'=>'Fimperkasa Utama','sector_id'=>8],
            ['kode'=>'FIRE','nama'=>'Alfa Energi Investama','sector_id'=>7],
            ['kode'=>'FISH','nama'=>'FKS Multi Agro','sector_id'=>3],
            ['kode'=>'FPNI','nama'=>'Lotte Chemical Titan','sector_id'=>10],
            ['kode'=>'FREN','nama'=>'Smartfren Telecom','sector_id'=>2],
            
            // G
            ['kode'=>'GAMA','nama'=>'Gading Development','sector_id'=>6],
            ['kode'=>'GDST','nama'=>'Gunawan Dianjaya Steel','sector_id'=>10],
            ['kode'=>'GDYR','nama'=>'Goodyear Indonesia','sector_id'=>10],
            ['kode'=>'GEMA','nama'=>'Gema Grahasarana','sector_id'=>10],
            ['kode'=>'GGIN','nama'=>'Gudang Garam','sector_id'=>3],
            ['kode'=>'GHON','nama'=>'Gihon Telekomunikasi Indonesia','sector_id'=>2],
            ['kode'=>'GIAA','nama'=>'Garuda Indonesia','sector_id'=>12],
            ['kode'=>'GIGS','nama'=>'Gigasol','sector_id'=>5],
            ['kode'=>'GLVA','nama'=>'Galva Technologies','sector_id'=>5],
            ['kode'=>'GOLD','nama'=>'Visi Telekomunikasi Infrastruktur','sector_id'=>8],
            ['kode'=>'GOLL','nama'=>'Golden Plantation','sector_id'=>3],
            ['kode'=>'GOOD','nama'=>'Garudafood Putra Putri Jaya','sector_id'=>3],
            ['kode'=>'GSMF','nama'=>'Equity Development Investment','sector_id'=>1],
            ['kode'=>'GTBO','nama'=>'Garda Tujuh Buana','sector_id'=>4],
            ['kode'=>'GWSA','nama'=>'Greenwood Sejahtera','sector_id'=>6],
            ['kode'=>'GZCO','nama'=>'Gozco Plantations','sector_id'=>3],
            
            // H & I
            ['kode'=>'HADE','nama'=>'Himalaya Energi Perkasa','sector_id'=>7],
            ['kode'=>'HDIT','nama'=>'HD Capital','sector_id'=>1],
            ['kode'=>'HDTX','nama'=>'Panasia Indo Resources','sector_id'=>10],
            ['kode'=>'HEAL','nama'=>'Medikaloka Hermina','sector_id'=>9],
            ['kode'=>'HEXA','nama'=>'Hexindo Adiperkasa','sector_id'=>10],
            ['kode'=>'HITS','nama'=>'Humpuss Intermoda Transportasi','sector_id'=>12],
            ['kode'=>'HOMI','nama'=>'Grand House Mulia','sector_id'=>6],
            ['kode'=>'HOPE','nama'=>'Harapan Duta Pertiwi','sector_id'=>10],
            ['kode'=>'HOTL','nama'=>'Saraswati Griya Lestari','sector_id'=>6],
            ['kode'=>'HRME','nama'=>'Menteng Heritage Realty','sector_id'=>6],
            ['kode'=>'IATA','nama'=>'Indonesia Transport & Infrastructure','sector_id'=>12],
            ['kode'=>'IBST','nama'=>'Inti Bangun Sejahtera','sector_id'=>8],
            ['kode'=>'IDPR','nama'=>'Indonesia Pondasi Raya','sector_id'=>8],
            ['kode'=>'IFII','nama'=>'Indonesia Fibreboard Industry','sector_id'=>10],
            ['kode'=>'IGAR','nama'=>'Champion Pacific Indonesia','sector_id'=>10],
            ['kode'=>'IIKP','nama'=>'Inti Agri Resources','sector_id'=>3],
            ['kode'=>'IKAI','nama'=>'Inti Kapuas Arowana','sector_id'=>10],
            ['kode'=>'IKAN','nama'=>'Era Mandiri Cemerlang','sector_id'=>3],
            ['kode'=>'IKBI','nama'=>'Sumi Indo Kabel','sector_id'=>8],
            ['kode'=>'IMJS','nama'=>'Indomobil Multi Jasa','sector_id'=>1],
            ['kode'=>'INAF','nama'=>'Indofarma','sector_id'=>9],
            ['kode'=>'INAI','nama'=>'Indal Aluminium Industry','sector_id'=>10],
            ['kode'=>'INCI','nama'=>'Intanwijaya Internasional','sector_id'=>10],
            ['kode'=>'INCO','nama'=>'Vale Indonesia','sector_id'=>4],
            ['kode'=>'INDO','nama'=>'Royalindo Investa Wijaya','sector_id'=>6],
            ['kode'=>'INDR','nama'=>'Indo-Rama Synthetics','sector_id'=>10],
            ['kode'=>'INDS','nama'=>'Indospring','sector_id'=>10],
            ['kode'=>'INET','nama'=>'Sinergi Inti Andalan Prima','sector_id'=>5],
            ['kode'=>'INKP','nama'=>'Indah Kiat Pulp & Paper','sector_id'=>10],
            ['kode'=>'INPC','nama'=>'Bank Artha Graha Internasional','sector_id'=>1],
            ['kode'=>'INPP','nama'=>'Indonesian Paradise Property','sector_id'=>6],
            ['kode'=>'INPS','nama'=>'Indah Prakasa Sentosa','sector_id'=>12],
            ['kode'=>'INRU','nama'=>'Toba Pulp Lestari','sector_id'=>10],
            ['kode'=>'INTA','nama'=>'Intraco Penta','sector_id'=>10],
            ['kode'=>'INTD','nama'=>'Inter Delta','sector_id'=>10],
            ['kode'=>'INTP','nama'=>'Indocement Tunggal Prakarsa','sector_id'=>10],
            ['kode'=>'IPCC','nama'=>'Indonesia Kendaraan Terminal','sector_id'=>12],
            ['kode'=>'IPCM','nama'=>'Jasa Armada Indonesia','sector_id'=>12],
            ['kode'=>'IPOL','nama'=>'Indopoly Swakarsa Industry','sector_id'=>10],
            ['kode'=>'IPTV','nama'=>'MNC Vision Networks','sector_id'=>11],
            ['kode'=>'IRRA','nama'=>'Itama Ranoraya','sector_id'=>9],
            ['kode'=>'ISAT','nama'=>'Indosat','sector_id'=>2],
            ['kode'=>'ISSP','nama'=>'Steel Pipe Industry of Indonesia','sector_id'=>10],
            ['kode'=>'ITIC','nama'=>'Indonesian Tobacco','sector_id'=>3],
            ['kode'=>'ITMA','nama'=>'Sumber Energi Andalan','sector_id'=>7],
        ];

        foreach ($emitens as $e) {
            $e['harga'] = 100;
            $e['market_cap'] = rand(5, 500);
            $e['npm'] = rand(-5, 30);
            $e['per'] = rand(5, 45);
            $e['pbv'] = rand(1, 10);
            $e['der'] = rand(0, 3);
            $e['roe'] = rand(-5, 25);
            $e['roa'] = rand(-5, 15);
            $e['dividend_yield'] = rand(0, 8);
            $e['ytd_return'] = rand(-20, 30);
            $e['one_year_return'] = rand(-30, 50);
            $e['three_year_return'] = rand(-50, 100);
            $e['volume'] = rand(1000000, 50000000);

            Emiten::updateOrCreate(['kode' => $e['kode']], $e);
        }
    }
}
