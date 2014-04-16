insert into MediaEncoding (
	media_set,
	default_type,
	title,
	shortname,
	default_encoding,
	width
) values (
	(select id from MediaSet where shortname = 'block'),
	(select id from MediaType where mime_type = 'video/mp4'),
	'720p',
	'720',
	true,
	720
);

insert into MediaEncoding (
	media_set,
	default_type,
	title,
	shortname,
	default_encoding,
	width
) values (
	(select id from MediaSet where shortname = 'block'),
	(select id from MediaType where mime_type = 'video/mp4'),
	'480p',
	'480',
	true,
	480
);

insert into MediaEncoding (
	media_set,
	default_type,
	title,
	shortname,
	default_encoding,
	width
) values (
	(select id from MediaSet where shortname = 'block'),
	(select id from MediaType where mime_type = 'video/mp4'),
	'360p',
	'360',
	true,
	360
);
