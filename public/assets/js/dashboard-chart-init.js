Morris.Area({
    element: 'morris-area-chart',
    data: [{
        bumdes: 'Lestari',
        aset: 91641500      
    },{
		bumdes: 'Karya Mandiri',
        aset: 50000000  	
	},{
		bumdes: 'Subur Makmur',
        aset: 30000000  	
	},{
		bumdes: 'Sejahtera',
        aset: 20500000  	
	},{
		bumdes: 'Maju Jaya',
        aset: 20000000  	
	},{
		bumdes: 'Sukses Bersama',
        aset: 15000000  	
	},{
		bumdes: 'Harapan Jaya',
        aset: 13500000  	
	},{
		bumdes: 'Sinar Sejahtera',
        aset: 10000000  	
	},{
		bumdes: 'Sinar Harapan',
        aset: 9000000  	
	},{
		bumdes: 'Maju Bersama',
        aset: 8000000  	
	}
	],
    xkey: 'bumdes',
    ykeys: ['aset'],
    labels: ['Aset'],
	parseTime: false,
    pointSize: 6,
    behaveLikeLine: true,
    lineWidth: 0,
    smooth: false,
    hideHover: 'auto',
    lineColors: ['#2DC716'],
	axes: false,
    resize: true
});

Morris.Bar({
    element: 'morris-bar-chart',
    data: [{
        bumdes: 'Lestari',
        modal: 200000000,
		realisasi: 100000000     
    },{
		bumdes: 'Karya Mandiri',
        modal: 150000000,
		realisasi: 50000000  	
	},{
		bumdes: 'Subur Makmur',
        modal: 100000000,
		realisasi: 30000000  	
	},{
		bumdes: 'Sejahtera',
        modal: 240000000,
		realisasi: 200500000  	
	},{
		bumdes: 'Maju Jaya',
        modal: 100000000,
		realisasi: 20000000  	
	},{
		bumdes: 'Sukses Bersama',
        modal: 120000000,
		realisasi: 80000000  	
	},{
		bumdes: 'Harapan Jaya',
        modal: 90000000,
		realisasi: 63500000  	
	},{
		bumdes: 'Sinar Sejahtera',
        modal: 170000000,
		realisasi: 70000000  	
	},{
		bumdes: 'Sinar Harapan',
        modal: 200000000,
		realisasi: 160000000  	
	},{
		bumdes: 'Maju Bersama',
        modal: 220000000,
		realisasi: 200000000  	
	}
	],
    xkey: 'bumdes',
    ykeys: ['modal','realisasi'],
    labels: ['Modal','realisasi'],
	parseTime: false,
    pointSize: 6,
    behaveLikeLine: true,
    lineWidth: 0,
    smooth: false,
    hideHover: 'auto',
    barColors: ['#2DC716','#D7DCE0'],
	axes: false,
    resize: true
}); 

Morris.Donut({
    element: 'morris-donut-chart',
    data: [{
        label: 'Simpan Pinjam',
        value: 170,
    },{
        label: 'Toko',
        value: 50
    },{
        label: 'Rental',
        value: 79
    },{
        label: 'Kredit Barang',
        value: 10
    }],
        resize: true,
        colors:['#2DC716', '#FEBE12', '#D7DCE0', '#26CEA6']
});

Morris.Donut({
    element: 'morris-donut-chart2',
    data: [{
        label: 'Modal',
        value: 1000,
    },{
        label: 'Realisasi',
        value: 500
    },{
        label: 'Piutang',
        value: 90
    },{
        label: 'Asset',
        value: 300
    }],
        resize: true,
        colors:['#2DC716', '#FEBE12', '#D7DCE0', '#26CEA6']
}); 

Morris.Donut({
    element: 'morris-donut-chart3',
    data: [{
        label: 'Harapan Jaya',
        value: 780,
    },{
        label: 'Sinar Sejahtera',
        value: 500
    },{
        label: 'Sinar Harapan',
        value: 120
    },{
        label: 'Maju Bersama',
        value: 350
    }],
        resize: true,
        colors:['#2DC716', '#FEBE12', '#D7DCE0', '#26CEA6']
}); 