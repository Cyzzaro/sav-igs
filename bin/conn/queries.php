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

$count_viva_aerobus_acumulado = "
SELECT 
	count(id) AS [Cuantos] 
FROM iamsa.dbo.viva_reserva 
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

$count_viva_aerobus_actual = "
SELECT 
	count(id) AS [Cuantos] 
FROM iamsa.dbo.viva_reserva 
WHERE FeeDate 
	BETWEEN 
		DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0) 
	AND 
		GETDATE()
";

$count_viva_aerobus_anterior = "
SELECT 
	count(id) AS [Cuantos] 
FROM iamsa.dbo.viva_reserva 
WHERE FeeDate 
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

$count_viva_aerobus_actual = "
SELECT 
	count(id) AS [Cuantos] 
FROM iamsa.dbo.viva_reserva 
WHERE FeeDate 
	BETWEEN 
		DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0) 
	AND 
		GETDATE()
";

$graph_etn_aers_acumulado = "
SELECT
  FORMAT(fecha_salida, 'yyyy-MM') AS Fecha
 ,COUNT(id) AS Total
FROM iamsa.dbo.viaje
GROUP BY FORMAT(fecha_salida, 'yyyy-MM')
ORDER BY FORMAT(fecha_salida, 'yyyy-MM')
";

$graph_viva_aerobus_acumulado = "
SELECT
  FORMAT(FeeDate, 'yyyy-MM') AS Fecha
 ,COUNT(id) AS Total
FROM iamsa.dbo.viva_reserva
GROUP BY FORMAT(FeeDate, 'yyyy-MM')
ORDER BY FORMAT(FeeDate, 'yyyy-MM')
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

$count_vigente_viva_aerobus = "
SELECT
	COUNT(id) AS Cuantos
FROM iamsa.dbo.viva_reserva
WHERE DepartureDate >= DATEADD(DAY, -5, GETDATE())
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
WHERE fecha_salida BETWEEN 
		DATEADD(mm,-2,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0))  and GETDATE()
GROUP BY FORMAT(fecha_salida, 'yyyy-MM-dd')
ORDER BY [Fecha]
";

$graph_viva_aerobus_diario = "
SELECT
	FORMAT(FeeDate, 'yyyy-MM-dd') AS [Fecha]
   ,COUNT(CASE
		WHEN FeeCode = 'VBABEX' THEN 1
		ELSE NULL
	END) AS [VBABEX]
	,COUNT(CASE
		WHEN FeeCode = 'VBABEZ' THEN 1
		ELSE NULL
	END) AS [VBABEZ]
	,COUNT(CASE
		WHEN FeeCode = 'VBABEW' THEN 1
		ELSE NULL
	END) AS [VBABEW]
	,COUNT(CASE
		WHEN FeeCode = 'VBABEY' THEN 1
		ELSE NULL
	END) AS [VBABEY]
	,COUNT(CASE
		WHEN FeeCode = 'VBABEV' THEN 1
		ELSE NULL
	END) AS [VBABEV]
   ,COUNT(id) AS [Total]
FROM iamsa.dbo.viva_reserva 
WHERE FeeDate BETWEEN 
		DATEADD(mm,-2,DATEADD(mm,DATEDIFF(mm,0,GETDATE()),0))  and GETDATE()
GROUP BY FORMAT(FeeDate, 'yyyy-MM-dd')
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
 'Viajes' Concepto
 ,cliente
 ,YEAR(fecha_salida) AS Anio
 ,COUNT(CASE WHEN DATEPART(m, fecha_salida)= 1 THEN 1 ELSE NULL END) Ene
 ,COUNT(CASE WHEN DATEPART(m, fecha_salida)= 2 THEN 1 ELSE NULL END) Feb
 ,COUNT(CASE WHEN DATEPART(m, fecha_salida)= 3 THEN 1 ELSE NULL END) Mar
 ,COUNT(CASE WHEN DATEPART(m, fecha_salida)= 4 THEN 1 ELSE NULL END) Abr
 ,COUNT(CASE WHEN DATEPART(m, fecha_salida)= 5 THEN 1 ELSE NULL END) May
 ,COUNT(CASE WHEN DATEPART(m, fecha_salida)= 6 THEN 1 ELSE NULL END) Jun
 ,COUNT(CASE WHEN DATEPART(m, fecha_salida)= 7 THEN 1 ELSE NULL END) Jul
 ,COUNT(CASE WHEN DATEPART(m, fecha_salida)= 8 THEN 1 ELSE NULL END) Ago
 ,COUNT(CASE WHEN DATEPART(m, fecha_salida)= 9 THEN 1 ELSE NULL END) Sep
 ,COUNT(CASE WHEN DATEPART(m, fecha_salida)=10 THEN 1 ELSE NULL END) Oct
 ,COUNT(CASE WHEN DATEPART(m, fecha_salida)=11 THEN 1 ELSE NULL END) Nov
 ,COUNT(CASE WHEN DATEPART(m, fecha_salida)=12 THEN 1 ELSE NULL END) Dic
 ,COUNT(Id) Total
FROM iamsa.dbo.viaje
GROUP BY YEAR(fecha_salida), cliente 
ORDER BY YEAR(fecha_salida) DESC, cliente ASC
";

$table_viva_aerobus_acumulado = "
SELECT
 'Viajes' Concepto
 ,FeeName
 ,YEAR(FeeDate) AS Anio
 ,COUNT(CASE WHEN DATEPART(m, FeeDate)= 1 THEN 1 ELSE NULL END) Ene
 ,COUNT(CASE WHEN DATEPART(m, FeeDate)= 2 THEN 1 ELSE NULL END) Feb
 ,COUNT(CASE WHEN DATEPART(m, FeeDate)= 3 THEN 1 ELSE NULL END) Mar
 ,COUNT(CASE WHEN DATEPART(m, FeeDate)= 4 THEN 1 ELSE NULL END) Abr
 ,COUNT(CASE WHEN DATEPART(m, FeeDate)= 5 THEN 1 ELSE NULL END) May
 ,COUNT(CASE WHEN DATEPART(m, FeeDate)= 6 THEN 1 ELSE NULL END) Jun
 ,COUNT(CASE WHEN DATEPART(m, FeeDate)= 7 THEN 1 ELSE NULL END) Jul
 ,COUNT(CASE WHEN DATEPART(m, FeeDate)= 8 THEN 1 ELSE NULL END) Ago
 ,COUNT(CASE WHEN DATEPART(m, FeeDate)= 9 THEN 1 ELSE NULL END) Sep
 ,COUNT(CASE WHEN DATEPART(m, FeeDate)=10 THEN 1 ELSE NULL END) Oct
 ,COUNT(CASE WHEN DATEPART(m, FeeDate)=11 THEN 1 ELSE NULL END) Nov
 ,COUNT(CASE WHEN DATEPART(m, FeeDate)=12 THEN 1 ELSE NULL END) Dic
 ,COUNT(Id) Total
FROM iamsa.dbo.viva_reserva
GROUP BY YEAR(FeeDate), FeeName
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