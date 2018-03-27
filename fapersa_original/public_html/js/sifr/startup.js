var futura = {src: 'futura-condensed.swf'};

sIFR.useStyleCheck = true;
sIFR.activate(futura);

sIFR.replace(futura, {
  selector: '.header .info',css: {
	'.sIFR-root': { 'color': '#FFFFFF', 'font-size':'15px', 'text-align':'right'}
  }, wmode: 'transparent'
});
sIFR.replace(futura, {
  selector: '.title2',css: {
	'.sIFR-root': { 'color': '#333333', 'font-size':'15px'}
  }, wmode: 'transparent'
});
sIFR.replace(futura, {
  selector: '.title_sm',css: {
	'.sIFR-root': { 'color': '#06669F', 'font-size':'16px','text-decoration':'underline'}, 
	'a': { 'color': '#06669F','font-size':'16px','cursor':'pointer','text-decoration':'underline'},
	'a:hover': {'color': '#06669F','text-decoration':'none' }
  }, wmode: 'transparent'
});
sIFR.replace(futura, {
  selector: '.boxdark_m .title1',css: {
	'.sIFR-root': { 'color': '#06669F','padding-bottom':'10px', 'font-size':'21px', 'text-align':'center'}
  }, wmode: 'transparent'
});
/*
sIFR.replace(futura, {
  selector: '.title3',css: {
	'.sIFR-root': { 'color': '#06669F','padding-bottom':'10px', 'font-size':'26px'}
  }, wmode: 'transparent'
});
*/
sIFR.replace(futura, {
  selector: '.boxt .title4',css: {
	'.sIFR-root': { 'color': '#044267', 'font-size':'25px'}
  }, wmode: 'transparent'
});

//replacement for a links in the sidebar
sIFR.replace(futura, {
  selector: '.menucats li',css: {
	'a': { 'color': '#3092CE','font-size':'17px','cursor':'pointer','text-decoration':'none'},'a:hover': {'color': '#3092CE','text-decoration':'underline' }
  }, wmode: 'transparent'
});

sIFR.replace(futura, {
  selector: '.sidebar .title4',css: {
	'.sIFR-root': { 'color': '#044267', 'font-size':'30px'}
  }, wmode: 'transparent'
});