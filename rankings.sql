SELECT 
	SUM(CASE WHEN (Floor = 1 AND Side = 'E') THEN TotalPoints ELSE 0 END) AS 'FloorE1',
	SUM(CASE WHEN (Floor = 2 AND Side = 'E') THEN TotalPoints ELSE 0 END) AS 'FloorE2',
	SUM(CASE WHEN (Floor = 3 AND Side = 'E') THEN TotalPoints ELSE 0 END) AS 'FloorE3',
	SUM(CASE WHEN (Floor = 4 AND Side = 'E') THEN TotalPoints ELSE 0 END) AS 'FloorE4',
	SUM(CASE WHEN (Floor = 5 AND Side = 'E') THEN TotalPoints ELSE 0 END) AS 'FloorE5',
	SUM(CASE WHEN (Floor = 6 AND Side = 'E') THEN TotalPoints ELSE 0 END) AS 'FloorE6',
	SUM(CASE WHEN (Floor = 7 AND Side = 'E') THEN TotalPoints ELSE 0 END) AS 'FloorE7',
	SUM(CASE WHEN (Floor = 8 AND Side = 'E') THEN TotalPoints ELSE 0 END) AS 'FloorE8',
	SUM(CASE WHEN (Floor = 1 AND Side = 'W') THEN TotalPoints ELSE 0 END) AS 'FloorW1',
	SUM(CASE WHEN (Floor = 2 AND Side = 'W') THEN TotalPoints ELSE 0 END) AS 'FloorW2',
	SUM(CASE WHEN (Floor = 3 AND Side = 'W') THEN TotalPoints ELSE 0 END) AS 'FloorW3',
	SUM(CASE WHEN (Floor = 4 AND Side = 'W') THEN TotalPoints ELSE 0 END) AS 'FloorW4',
	SUM(CASE WHEN (Floor = 5 AND Side = 'W') THEN TotalPoints ELSE 0 END) AS 'FloorW5',
	SUM(CASE WHEN (Floor = 6 AND Side = 'W') THEN TotalPoints ELSE 0 END) AS 'FloorW6',
	SUM(CASE WHEN (Floor = 7 AND Side = 'W') THEN TotalPoints ELSE 0 END) AS 'FloorW7',
	SUM(CASE WHEN (Floor = 8 AND Side = 'W') THEN TotalPoints ELSE 0 END) AS 'FloorW8'
FROM phoenix_students