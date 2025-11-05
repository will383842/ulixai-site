const https = require('https');
const fs = require('fs');
const path = require('path');

// Liste des codes ISO des 197 pays
const countries = [
  'ad','ae','af','ag','ai','al','am','ao','aq','ar','as','at','au','aw','ax','az',
  'ba','bb','bd','be','bf','bg','bh','bi','bj','bl','bm','bn','bo','bq','br','bs','bt','bv','bw','by','bz',
  'ca','cc','cd','cf','cg','ch','ci','ck','cl','cm','cn','co','cr','cu','cv','cw','cx','cy','cz',
  'de','dj','dk','dm','do','dz',
  'ec','ee','eg','eh','er','es','et','eu',
  'fi','fj','fk','fm','fo','fr',
  'ga','gb','gd','ge','gf','gg','gh','gi','gl','gm','gn','gp','gq','gr','gs','gt','gu','gw','gy',
  'hk','hm','hn','hr','ht','hu',
  'id','ie','il','im','in','io','iq','ir','is','it',
  'je','jm','jo','jp',
  'ke','kg','kh','ki','km','kn','kp','kr','kw','ky','kz',
  'la','lb','lc','li','lk','lr','ls','lt','lu','lv','ly',
  'ma','mc','md','me','mf','mg','mh','mk','ml','mm','mn','mo','mp','mq','mr','ms','mt','mu','mv','mw','mx','my','mz',
  'na','nc','ne','nf','ng','ni','nl','no','np','nr','nu','nz',
  'om',
  'pa','pe','pf','pg','ph','pk','pl','pm','pn','pr','ps','pt','pw','py',
  'qa',
  're','ro','rs','ru','rw',
  'sa','sb','sc','sd','se','sg','sh','si','sj','sk','sl','sm','sn','so','sr','ss','st','sv','sx','sy','sz',
  'tc','td','tf','tg','th','tj','tk','tl','tm','tn','to','tr','tt','tv','tw','tz',
  'ua','ug','um','us','uy','uz',
  'va','vc','ve','vg','vi','vn','vu',
  'wf','ws',
  'ye','yt',
  'za','zm','zw'
];

const flagsDir = path.join(__dirname, 'public', 'images', 'flags');

// Créer le dossier s'il n'existe pas
if (!fs.existsSync(flagsDir)) {
  fs.mkdirSync(flagsDir, { recursive: true });
}

let downloaded = 0;
let errors = 0;

console.log(`📥 Téléchargement de ${countries.length} drapeaux...`);

countries.forEach((code, index) => {
  const url = `https://raw.githubusercontent.com/lipis/flag-icons/main/flags/4x3/${code}.svg`;
  const filePath = path.join(flagsDir, `${code}.svg`);

  https.get(url, (response) => {
    if (response.statusCode === 200) {
      const fileStream = fs.createWriteStream(filePath);
      response.pipe(fileStream);
      
      fileStream.on('finish', () => {
        fileStream.close();
        downloaded++;
        
        if ((index + 1) % 20 === 0) {
          console.log(`✅ ${downloaded}/${countries.length} téléchargés...`);
        }
        
        if (downloaded + errors === countries.length) {
          console.log(`\n🎉 Terminé ! ${downloaded} drapeaux téléchargés avec succès.`);
          if (errors > 0) {
            console.log(`⚠️  ${errors} erreurs.`);
          }
        }
      });
    } else {
      errors++;
      console.error(`❌ Erreur ${code}: ${response.statusCode}`);
    }
  }).on('error', (err) => {
    errors++;
    console.error(`❌ Erreur ${code}:`, err.message);
  });
});