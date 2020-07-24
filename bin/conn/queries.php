<?php

$count_afiliados_actual = "
SELECT 
    COUNT(id) AS [Cuantos] 
FROM tmk.dbo.afiliados 
WHERE fecha_venta 
	BETWEEN 
		DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0) 
	AND 
		GETDATE()
";

$graph_afiliados_actual = "
SELECT
    FORMAT(fecha_venta, 'yyyy-MM-dd') AS [Actual]
   ,COUNT(id) AS [Afiliados]
FROM tmk.dbo.afiliados
WHERE fecha_venta 
	BETWEEN 
		DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0) 
	AND 
		GETDATE()
GROUP BY FORMAT(fecha_venta, 'yyyy-MM-dd')
ORDER BY [Actual]
";
    
$count_afiliados_anterior = "
SELECT
    COUNT(id) AS [Cuantos]
FROM tmk.dbo.afiliados
WHERE fecha_venta 
	BETWEEN 
		DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)) 
	AND 
		DATEADD(ms,-3,DATEADD(mm,0,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)))
";

$graph_afiliados_anterior = "
SELECT
    FORMAT(fecha_venta, 'yyyy-MM-dd') AS [Anterior]
   ,COUNT(id) AS [Afiliados]
FROM tmk.dbo.afiliados
WHERE fecha_venta 
	BETWEEN 
		DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)) 
	AND 
		DATEADD(ms,-3,DATEADD(mm,0,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)))
GROUP BY FORMAT(fecha_venta, 'yyyy-MM-dd')
ORDER BY [Anterior]
";

$count_afiliados_anterior_1 = "
SELECT
    COUNT(id) AS [Cuantos]
FROM tmk.dbo.afiliados
WHERE fecha_venta 
	BETWEEN 
		DATEADD(mm,-2,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)) 
	AND 
		DATEADD(ms,-3,DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)))
";

$graph_afiliados_anterior_1 = "
SELECT
    FORMAT(fecha_venta, 'yyyy-MM-dd') AS [Anterior_1]
   ,COUNT(id) AS [Afiliados]
FROM tmk.dbo.afiliados
WHERE fecha_venta 
	BETWEEN 
		DATEADD(mm,-2,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)) 
	AND 
		DATEADD(ms,-3,DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)))
GROUP BY FORMAT(fecha_venta, 'yyyy-MM-dd')
ORDER BY [Anterior_1]
";

$count_afiliados_acumulado = "
SELECT
    COUNT(id) AS [Cuantos]
FROM tmk.dbo.afiliados
";

$graph_afiliados_acumulado = "
SELECT
    FORMAT(fecha_venta, 'yyyy-MM') AS [Acumulado]
   ,COUNT(id) AS [Afiliados]
FROM tmk.dbo.afiliados
GROUP BY FORMAT(fecha_venta, 'yyyy-MM')
ORDER BY FORMAT(fecha_venta, 'yyyy-MM')
";

$count_bajas_actual = "
SELECT
    COUNT(id) AS [Cuantos]
FROM tmk.dbo.afiliados
WHERE (estatus IS NOT NULL AND estatus NOT LIKE '%RESERVAR%') AND fecha_estatus 
	BETWEEN 
		DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0) 
	AND 
		GETDATE()
";

$graph_bajas_actual = "
SELECT
    FORMAT(fecha_estatus, 'yyyy-MM-dd') AS [Actual]
   ,COUNT(id) AS [Bajas]
FROM tmk.dbo.afiliados
WHERE (estatus IS NOT NULL AND estatus NOT LIKE '%RESERVAR%') AND fecha_estatus 
	BETWEEN 
		DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0) 
	AND 
		GETDATE()
GROUP BY FORMAT(fecha_estatus, 'yyyy-MM-dd')
ORDER BY [Actual]
";

$count_bajas_anterior = "
SELECT
    COUNT(id) AS [Cuantos]
FROM tmk.dbo.afiliados
WHERE (estatus IS NOT NULL AND estatus NOT LIKE '%RESERVAR%') AND fecha_estatus 
	BETWEEN 
		DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)) 
	AND 
		DATEADD(ms,-3,DATEADD(mm,0,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)))
";

$graph_bajas_anterior = "
SELECT
    FORMAT(fecha_estatus, 'yyyy-MM-dd') AS [Anterior]
   ,COUNT(id) AS [Bajas]
FROM tmk.dbo.afiliados
WHERE (estatus IS NOT NULL AND estatus NOT LIKE '%RESERVAR%') AND fecha_estatus 
	BETWEEN 
		DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)) 
	AND 
		DATEADD(ms,-3,DATEADD(mm,0,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)))
GROUP BY FORMAT(fecha_estatus, 'yyyy-MM-dd')
ORDER BY [Anterior]
";

$count_bajas_anterior_1 = "
SELECT
    COUNT(id) AS [Cuantos]
FROM tmk.dbo.afiliados
WHERE (estatus IS NOT NULL AND estatus NOT LIKE '%RESERVAR%') AND fecha_estatus 
	BETWEEN 
		DATEADD(mm,-2,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)) 
	AND 
		DATEADD(ms,-3,DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)))
";

$graph_bajas_anterior_1 = "
SELECT
    FORMAT(fecha_estatus, 'yyyy-MM-dd') AS [Anterior_1]
   ,COUNT(id) AS [Bajas]
FROM tmk.dbo.afiliados
WHERE (estatus IS NOT NULL AND estatus NOT LIKE '%RESERVAR%') AND fecha_estatus 
	BETWEEN 
		DATEADD(mm,-2,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)) 
	AND 
		DATEADD(ms,-3,DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)))
GROUP BY FORMAT(fecha_estatus, 'yyyy-MM-dd')
ORDER BY [Anterior_1]
";

$count_bajas_acumulado = "
SELECT
    COUNT(id) AS [Cuantos]
FROM tmk.dbo.afiliados
WHERE (estatus IS NOT NULL AND estatus NOT LIKE '%RESERVAR%')
";

$graph_bajas_acumulado = "
SELECT
    FORMAT(fecha_estatus, 'yyyy-MM') AS [Acumulado]
   ,COUNT(id) AS [Bajas]
FROM tmk.dbo.afiliados
WHERE (estatus IS NOT NULL AND estatus NOT LIKE '%RESERVAR%')
GROUP BY FORMAT(fecha_estatus, 'yyyy-MM')
ORDER BY FORMAT(fecha_estatus, 'yyyy-MM')
";

$count_cobros_actual = "
SELECT
    COUNT(id) AS [Cuantos]
FROM tmk.dbo.procesados
WHERE evento = '00 VENTAS' AND fecha_procesado 
	BETWEEN 
		DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0) 
	AND 
		GETDATE()
";

$graph_cobros_actual = "
SELECT
	FORMAT(fecha_procesado, 'yyyy-MM-dd') AS [Actual]
   ,COUNT(id) AS [Cobros]
FROM tmk.dbo.procesados
WHERE evento = '00 VENTAS' AND fecha_procesado 
	BETWEEN 
		DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0) 
	AND 
		GETDATE()
GROUP BY FORMAT(fecha_procesado, 'yyyy-MM-dd')
ORDER BY [Actual]
";

$count_cobros_anterior = "
SELECT
	COUNT(id) AS [Cuantos]
FROM tmk.dbo.procesados
WHERE evento = '00 VENTAS' AND fecha_procesado 
	BETWEEN 
		DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)) 
	AND 
		DATEADD(ms,-3,DATEADD(mm,0,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)))
";

$graph_cobros_anterior = "
SELECT
	FORMAT(fecha_procesado, 'yyyy-MM-dd') AS [Anterior]
   ,COUNT(id) AS [Cobros]
FROM tmk.dbo.procesados
WHERE evento = '00 VENTAS' AND fecha_procesado 
	BETWEEN 
		DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)) 
	AND 
		DATEADD(ms,-3,DATEADD(mm,0,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)))
GROUP BY FORMAT(fecha_procesado, 'yyyy-MM-dd')
ORDER BY [Anterior]
";

$count_cobros_anterior_1 = "
SELECT
	COUNT(id) AS [Cuantos]
FROM tmk.dbo.procesados
WHERE evento = '00 VENTAS' AND fecha_procesado 
	BETWEEN 
		DATEADD(mm,-2,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)) 
	AND 
		DATEADD(ms,-3,DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)))
";

$graph_cobros_anterior_1 = "
SELECT
	FORMAT(fecha_procesado, 'yyyy-MM-dd') AS [Anterior_1]
   ,COUNT(id) AS [Cobros]
FROM tmk.dbo.procesados
WHERE evento = '00 VENTAS' AND fecha_procesado 
	BETWEEN 
		DATEADD(mm,-2,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)) 
	AND 
		DATEADD(ms,-3,DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)))
GROUP BY FORMAT(fecha_procesado, 'yyyy-MM-dd')
ORDER BY [Anterior_1]
";

$count_cobros_acumulado = "
SELECT
	COUNT(id) AS [Cuantos]
FROM tmk.dbo.procesados
WHERE evento = '00 VENTAS'
";

$graph_cobros_acumulado = "
SELECT
	FORMAT(fecha_procesado, 'yyyy-MM') AS [Acumulado]
   ,COUNT(id) AS [Cobros]
FROM tmk.dbo.procesados
WHERE evento = '00 VENTAS'
GROUP BY FORMAT(fecha_procesado, 'yyyy-MM')
ORDER BY FORMAT(fecha_procesado, 'yyyy-MM')
";

$count_reservar_actual =" 
SELECT
	COUNT(id) as [Cuantos]
FROM tmk.dbo.afiliados
WHERE estatus = 'RESERVAR'
AND fecha_estatus 
	BETWEEN 
		DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0) 
	AND 
		GETDATE()
";

$graph_reservar_actual = "
SELECT
	FORMAT(fecha_estatus, 'yyyy-MM-dd') AS [Actual]
   ,COUNT(id) AS [Reservar]
FROM tmk.dbo.afiliados
WHERE estatus = 'RESERVAR' AND fecha_estatus 
	BETWEEN 
		DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0) 
	AND 
		GETDATE()
GROUP BY FORMAT(fecha_estatus, 'yyyy-MM-dd')
ORDER BY [Actual]
";

$count_reservar_anterior = "
SELECT
	COUNT(id) as [Cuantos]
FROM tmk.dbo.afiliados
WHERE estatus = 'RESERVAR'
AND fecha_estatus 
	BETWEEN 
		DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)) 
	AND 
		DATEADD(ms,-3,DATEADD(mm,0,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)))
";

$graph_reservar_anterior = "
SELECT
	FORMAT(fecha_estatus, 'yyyy-MM-dd') AS [Anterior]
   ,COUNT(id) AS [Reservar]
FROM tmk.dbo.afiliados
WHERE estatus = 'RESERVAR' AND fecha_estatus 
	BETWEEN 
		DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)) 
	AND 
		DATEADD(ms,-3,DATEADD(mm,0,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)))
GROUP BY FORMAT(fecha_estatus, 'yyyy-MM-dd')
ORDER BY [Anterior]
";

$count_reservar_anterior_1 = "
SELECT
	COUNT(id) as [Cuantos]
FROM tmk.dbo.afiliados
WHERE estatus = 'RESERVAR'
AND fecha_estatus 
	BETWEEN 
		DATEADD(mm,-2,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)) 
	AND 
		DATEADD(ms,-3,DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)))
";

$graph_reservar_anterior_1 = "
SELECT
	FORMAT(fecha_estatus, 'yyyy-MM-dd') AS [Anterior_1]
   ,COUNT(id) AS [Reservar]
FROM tmk.dbo.afiliados
WHERE estatus = 'RESERVAR' AND fecha_estatus 
	BETWEEN 
		DATEADD(mm,-2,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)) 
	AND 
		DATEADD(ms,-3,DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)))
GROUP BY FORMAT(fecha_estatus, 'yyyy-MM-dd')
ORDER BY [Anterior_1]
";

$count_reservar_acumulado = "
SELECT
	COUNT(id) as [Cuantos]
FROM tmk.dbo.afiliados
WHERE estatus = 'RESERVAR'
";

$graph_reservar_acumulado = "
SELECT
	FORMAT(fecha_estatus, 'yyyy-MM') AS [Acumulado]
   ,COUNT(id) AS [Reservar]
FROM tmk.dbo.afiliados
WHERE estatus = 'RESERVAR'
GROUP BY FORMAT(fecha_estatus, 'yyyy-MM')
ORDER BY FORMAT(fecha_estatus, 'yyyy-MM')
";

$count_iamsa_acumulado = "
SELECT 
	count(id) AS [Cuantos] 
FROM iamsa.dbo.viaje 
";

$count_iamsa_anterior = "
SELECT 
	count(id) AS [Cuantos] 
FROM iamsa.dbo.viaje 
WHERE fecha_salida 
	BETWEEN 
		DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)) 
	AND 
		DATEADD(ms,-3,DATEADD(mm,0,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)))
";

$count_iamsa_actual = "
SELECT 
	count(id) AS [Cuantos] 
FROM iamsa.dbo.viaje 
WHERE fecha_salida 
	BETWEEN 
		DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0) 
	AND 
		GETDATE()
";

$graph_iamsa_acumulado = "
SELECT 
	[Fecha],
	[Total] 
FROM iamsa.dbo.vw_afiliados_etn  
WHERE [Fecha] <> 'Total' 
ORDER BY [Fecha] ASC
";

$count_iamsa_etn_acumulado = "
SELECT 
	count(id) AS [Cuantos] 
FROM iamsa.dbo.viaje 
WHERE cliente = 'ETN'
";

$count_iamsa_etn_anterior = "
SELECT 
	count(id) AS [Cuantos] 
FROM iamsa.dbo.viaje 
WHERE cliente = 'ETN' AND fecha_salida 
	BETWEEN 
		DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)) 
	AND 
		DATEADD(ms,-3,DATEADD(mm,0,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)))
";

$count_iamsa_etn_actual = "
SELECT 
	count(id) AS [Cuantos] 
FROM iamsa.dbo.viaje 
WHERE cliente = 'ETN' AND fecha_salida 
	BETWEEN 
		DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0) 
	AND 
		GETDATE()
";

$count_iamsa_aers_acumulado = "
SELECT 
	count(id) AS [Cuantos] 
FROM iamsa.dbo.viaje 
WHERE cliente = 'AERS'
";

$count_iamsa_aers_anterior = "
SELECT 
	count(id) AS [Cuantos] 
FROM iamsa.dbo.viaje 
WHERE cliente = 'AERS' AND fecha_salida 
	BETWEEN 
		DATEADD(mm,-1,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)) 
	AND 
		DATEADD(ms,-3,DATEADD(mm,0,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0)))
";

$count_iamsa_aers_actual = "
SELECT 
	count(id) AS [Cuantos] 
FROM iamsa.dbo.viaje 
WHERE cliente = 'AERS' AND fecha_salida 
	BETWEEN 
		DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0) 
	AND 
		GETDATE()
";

$count_vigente_etn_aers = "
SELECT
	COUNT(id) AS Cuantos
FROM iamsa.dbo.viaje
WHERE fecha_salida >= DATEADD(DAY, -5, GETDATE())
";

$count_vigente_etn = "
SELECT
	COUNT(CASE
		WHEN cliente = 'ETN' THEN 1
		ELSE NULL
	END) AS ETN
FROM iamsa.dbo.viaje
WHERE fecha_salida >= DATEADD(DAY, -5, GETDATE())
";

$count_vigente_aers = "
SELECT
	COUNT(CASE
		WHEN cliente = 'AERS' THEN 1
		ELSE NULL
	END) AS AERS
FROM iamsa.dbo.viaje
WHERE fecha_salida >= DATEADD(DAY, -5, GETDATE())
";

$graph_iamsa_diario = "
SELECT
	FORMAT(fecha_salida, 'yyyy-MM-dd') AS [Fecha]
   ,COUNT(CASE
		WHEN cliente = 'ETN' THEN 1
		ELSE NULL
	END) AS [ETN]
   ,COUNT(CASE
		WHEN cliente = 'AERS' THEN 1
		ELSE NULL
	END) AS [AERS]
   ,COUNT(id) AS [Total]
FROM iamsa.dbo.viaje 
WHERE fecha_salida 
	BETWEEN 
		CONVERT(DATE, DATEADD(d, -( DAY(DATEADD(m, -1, GETDATE() -1)) ), DATEADD(m, -1, GETDATE()))) AND GETDATE()
GROUP BY FORMAT(fecha_salida, 'yyyy-MM-dd')
ORDER BY [Fecha]
";

$graph_iamsa_mensual = "
SELECT
	[Fecha]
   ,[ETN]
   ,[AERS]
   ,[Total]
FROM iamsa.dbo.vw_afiliados_etn 
WHERE [Fecha] NOT LIKE '%Total%'
ORDER BY [Fecha] DESC
";

$table_iamsa_acumulado = "
SELECT
	FORMAT(fecha_salida, 'yyyy-MM') AS [Fecha]
   ,COUNT(CASE
		WHEN cliente = 'ETN' THEN 1
		ELSE NULL
	END) AS [ETN $15.00]
   ,COUNT(CASE
		WHEN cliente = 'AERS' AND
			importe = 15.00 THEN 1
		ELSE NULL
	END) AS [AERS $15.00]
   ,COUNT(CASE
		WHEN cliente = 'AERS' AND
			importe = 10.00 THEN 1
		ELSE NULL
	END) AS [AERS $10.00]
   ,COUNT(CASE
		WHEN cliente = 'AERS' AND
			importe = 4.00 THEN 1
		ELSE NULL
	END) AS [AERS $4.00]
   ,COUNT(CASE
   		WHEN importe NOT IN ('15.00', '10.00', '4.00') THEN 1
   		ELSE NULL
   	END) AS [OTROS]
   ,COUNT(id) AS [Total]
FROM iamsa.dbo.viaje
GROUP BY FORMAT(fecha_salida, 'yyyy-MM')
UNION ALL
SELECT
	'Total' AS [Fecha]
   ,COUNT(CASE
		WHEN cliente = 'ETN' THEN 1
		ELSE NULL
	END) AS [ETN $15.00]
   ,COUNT(CASE
		WHEN cliente = 'AERS' AND
			importe = 15.00 THEN 1
		ELSE NULL
	END) AS [AERS $15.00]
   ,COUNT(CASE
		WHEN cliente = 'AERS' AND
			importe = 10.00 THEN 1
		ELSE NULL
	END) AS [AERS $10.00]
   ,COUNT(CASE
		WHEN cliente = 'AERS' AND
			importe = 4.00 THEN 1
		ELSE NULL
	END) AS [AERS $4.00]
   ,COUNT(CASE
   		WHEN importe in ('77.00', '110.00', '230.50', '332.50', '337.50', '380.00', '461.00', '0.00') THEN 1
   		ELSE NULL
   	END) AS [OTROS]
	,COUNT(id) AS [Total]
FROM iamsa.dbo.viaje
ORDER BY [Fecha]
";


/**
*	Para la DB de Apolo
*/
$asistencias_programadas_apolo = "
SELECT 
	CASE
		WHEN DATEDIFF(a.fechaprogramada, CURDATE()) < 0 THEN '4. Negro'
		WHEN DATEDIFF(a.fechaprogramada, CURDATE()) = 0 THEN '3. Rojo'
		WHEN DATEDIFF(a.fechaprogramada, CURDATE()) = 1 THEN '3. Rojo'
		WHEN DATEDIFF(a.fechaprogramada, CURDATE()) = 2 THEN '2. Amarillo'
		WHEN DATEDIFF(a.fechaprogramada, CURDATE()) = 3 THEN '2. Amarillo'
		ELSE '1. Verde'
	END AS 'Semaforo',
	a.numero AS 'Expediente',
	
	h.nombre AS 'Plan',
	y.nombre AS 'Estado',
	z.nombre AS 'Municipio',
	p.nombre AS 'Prioridad',
	s.nombre AS 'Servicio',
	x.nombre AS 'Proveedor',
	c.nombre AS 'Cobertura',
	CAST(a.fechasolicitud AS DATE) AS 'FechaSolicitud',
	a.fechaprogramada AS 'Programada',
	a.horadesde AS 'Desde',
	a.horahasta AS 'Hasta'
FROM
	mx.asistencia a LEFT JOIN
	mx.estadoasistencia e ON a.estado = e.id LEFT JOIN
	mx.servicio s ON a.servicio = s.id LEFT JOIN
	mx.categoriadeasistencia c ON a.categoria = c.id LEFT JOIN
	mx.prioridadcategoria p ON a.prioridad = p.id LEFT JOIN
	mx.proveedor x ON a.proveedor = x.id LEFT JOIN
	mx.provincia y ON a.provincia = y.id LEFT JOIN
	mx.zona z ON a.zona = z.id LEFT JOIN
	mx.expediente f ON a.expediente = f.numero LEFT JOIN
	mx.cuenta g ON f.cuenta = g.id LEFT JOIN
	mx.plan h ON f.plan = h.id
WHERE
	a.fechaprogramada IS NOT NULL
		AND (e.id = 4 OR e.id = 6 OR e.id = 7)
	ORDER BY
		Semaforo DESC, Prioridad ASC    
;";
    
?>