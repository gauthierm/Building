insert into ImageDimension (
	image_set,
	default_type,
	shortname,
	title,
	max_width,
	max_height,
	crop,
	dpi,
	quality,
	strip,
	interlace,
	resize_filter,
	upscale
) values (
	(select id from ImageSet where shortname = 'block'),
	(select id from ImageType where mime_type = 'image/jpeg'),
	'original',
	'Original',
	null,
	null,
	false,
	72,
	85,
	true,
	false,
	null,
	false
);

insert into ImageDimension (
	image_set,
	default_type,
	shortname,
	title,
	max_width,
	max_height,
	crop,
	dpi,
	quality,
	strip,
	interlace,
	resize_filter,
	upscale
) values (
	(select id from ImageSet where shortname = 'block'),
	(select id from ImageType where mime_type = 'image/jpeg'),
	'720',
	'720',
	720,
	720,
	false,
	72,
	85,
	true,
	false,
	null,
	false
);

insert into ImageDimension (
	image_set,
	default_type,
	shortname,
	title,
	max_width,
	max_height,
	crop,
	dpi,
	quality,
	strip,
	interlace,
	resize_filter,
	upscale
) values (
	(select id from ImageSet where shortname = 'block'),
	(select id from ImageType where mime_type = 'image/jpeg'),
	'360',
	'360',
	360,
	360,
	false,
	72,
	85,
	true,
	false,
	null,
	false
);

insert into ImageDimension (
	image_set,
	default_type,
	shortname,
	title,
	max_width,
	max_height,
	crop,
	dpi,
	quality,
	strip,
	interlace,
	resize_filter,
	upscale
) values (
	(select id from ImageSet where shortname = 'block'),
	(select id from ImageType where mime_type = 'image/jpeg'),
	'thumb',
	'Thumbnail',
	100,
	100,
	false,
	72,
	85,
	true,
	false,
	null,
	false
);

insert into ImageDimension (
	image_set,
	default_type,
	shortname,
	title,
	max_width,
	max_height,
	crop,
	dpi,
	quality,
	strip,
	interlace,
	resize_filter,
	upscale
) values (
	(select id from ImageSet where shortname = 'block'),
	(select id from ImageType where mime_type = 'image/jpeg'),
	'icon',
	'Icon',
	96,
	96,
	true,
	72,
	85,
	true,
	false,
	null,
	false
);
