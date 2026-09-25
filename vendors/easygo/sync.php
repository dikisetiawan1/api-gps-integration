<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/get_data.php';

header('Content-Type: application/json; charset=utf-8');




try {

    // Ambil data dari API Easygo
    $response = getEasygoData();

        if (
          !isset($response['data']) ||
          !is_array($response['data'])
      ) {
          throw new Exception('Data kendaraan Easygo tidak ditemukan.');
      }


      if (
        !isset($response['data']) ||
        !is_array($response['data'])
    ) {
        throw new Exception(
            'Data kendaraan Easygo tidak ditemukan.'
        );
    }

    $vehicles = $response['data'];

    $pdo->beginTransaction();

    /*
            UPSERT DATA KE DATABASE 
    */

    $sql = "INSERT INTO tbl_easygo (
            vehicle_id,
            company_id,
            company_name,
            driver_id,
            trip_driver_id,
            driver_name,
            license_plate,
            hull_no,
            imei,
            latitude,
            longitude,
            altitude,
            temperature_1,
            temperature_2,
            temperature_3,
            fuel,
            fuel_filtered,
            fuel_capacity,
            sum_fuel,
            trip_fuel,
            sum_distance,
            trip_distance,
            sum_drivetime,
            trip_drivetime,
            sum_drivetime_formatted,
            trip_drivetime_formatted,
            speed,
            calculated_speed,
            direction,
            signal_strength,
            battery,
            harsh_brakes,
            harsh_accels,
            sharp_turns,
            overspeeds,
            fence_ctr,
            door1_status,
            door2_status,
            refrigerator_status,
            trip_maxspeed,
            motion_status,
            calculated_motion_status,
            engine_on,
            battery_alarm_set,
            gsm_alarm_set,
            tripstart_on,
            tripstart_long,
            tripstart_lat,
            address,
            province,
            city,
            district,
            geolocations,
            vehicle_groups,
            battery_ble,
            last_packet,
            last_receive,
            last_motion,
            last_status_chg,
            driver_change_on,
            last_door1_data,
            last_door1_alert,
            last_door2_alert,
            last_speed_alert,
            last_summary,
            requested_date) 
            VALUES (
            :vehicle_id,
            :company_id,
            :company_name,
            :driver_id,
            :trip_driver_id,
            :driver_name,
            :license_plate,
            :hull_no,
            :imei,
            :latitude,
            :longitude,
            :altitude,
            :temperature_1,
            :temperature_2,
            :temperature_3,
            :fuel,
            :fuel_filtered,
            :fuel_capacity,
            :sum_fuel,
            :trip_fuel,
            :sum_distance,
            :trip_distance,
            :sum_drivetime,
            :trip_drivetime,
            :sum_drivetime_formatted,
            :trip_drivetime_formatted,
            :speed,
            :calculated_speed,
            :direction,
            :signal_strength,
            :battery,
            :harsh_brakes,
            :harsh_accels,
            :sharp_turns,
            :overspeeds,
            :fence_ctr,
            :door1_status,
            :door2_status,
            :refrigerator_status,
            :trip_maxspeed,
            :motion_status,
            :calculated_motion_status,
            :engine_on,
            :battery_alarm_set,
            :gsm_alarm_set,
            :tripstart_on,
            :tripstart_long,
            :tripstart_lat,
            :address,
            :province,
            :city,
            :district,
            :geolocations,
            :vehicle_groups,
            :battery_ble,
            :last_packet,
            :last_receive,
            :last_motion,
            :last_status_chg,
            :driver_change_on,
            :last_door1_data,
            :last_door1_alert,
            :last_door2_alert,
            :last_speed_alert,
            :last_summary,
            :requested_date

            )ON DUPLICATE KEY UPDATE
            company_id = VALUES(company_id),
            company_name = VALUES(company_name),
            driver_id = VALUES(driver_id),
            trip_driver_id = VALUES(trip_driver_id),
            driver_name = VALUES(driver_name),
            license_plate = VALUES(license_plate),
            hull_no = VALUES(hull_no),
            imei = VALUES(imei),
            latitude = VALUES(latitude),
            longitude = VALUES(longitude),
            altitude = VALUES(altitude),
            temperature_1 = VALUES(temperature_1),
            temperature_2 = VALUES(temperature_2),
            temperature_3 = VALUES(temperature_3),
            fuel = VALUES(fuel),
            fuel_filtered = VALUES(fuel_filtered),
            fuel_capacity = VALUES(fuel_capacity),
            sum_fuel = VALUES(sum_fuel),
            trip_fuel = VALUES(trip_fuel),
            sum_distance = VALUES(sum_distance),
            trip_distance = VALUES(trip_distance),
            sum_drivetime = VALUES(sum_drivetime),
            trip_drivetime = VALUES(trip_drivetime),
            sum_drivetime_formatted = VALUES(sum_drivetime_formatted),
            trip_drivetime_formatted = VALUES(trip_drivetime_formatted),
            speed = VALUES(speed),
            calculated_speed = VALUES(calculated_speed),
            direction = VALUES(direction),
            signal_strength = VALUES(signal_strength),
            battery = VALUES(battery),
            harsh_brakes = VALUES(harsh_brakes),
            harsh_accels = VALUES(harsh_accels),
            sharp_turns = VALUES(sharp_turns),
            overspeeds = VALUES(overspeeds),
            fence_ctr = VALUES(fence_ctr),
            door1_status = VALUES(door1_status),
            door2_status = VALUES(door2_status),
            refrigerator_status = VALUES(refrigerator_status),
            trip_maxspeed = VALUES(trip_maxspeed),
            motion_status = VALUES(motion_status),
            calculated_motion_status = VALUES(calculated_motion_status),
            engine_on = VALUES(engine_on),
            battery_alarm_set = VALUES(battery_alarm_set),
            gsm_alarm_set = VALUES(gsm_alarm_set),
            tripstart_on = VALUES(tripstart_on),
            tripstart_long = VALUES(tripstart_long),
            tripstart_lat = VALUES(tripstart_lat),
            address = VALUES(address),
            province = VALUES(province),
            city = VALUES(city),
            district = VALUES(district),
            geolocations = VALUES(geolocations),
            vehicle_groups = VALUES(vehicle_groups),
            battery_ble = VALUES(battery_ble),
            last_packet = VALUES(last_packet),
            last_receive = VALUES(last_receive),
            last_motion = VALUES(last_motion),
            last_status_chg = VALUES(last_status_chg),
            driver_change_on = VALUES(driver_change_on),
            last_door1_data = VALUES(last_door1_data),
            last_door1_alert = VALUES(last_door1_alert),
            last_door2_alert = VALUES(last_door2_alert),
            last_speed_alert = VALUES(last_speed_alert),
            last_summary = VALUES(last_summary),
            requested_date = VALUES(requested_date),
            updated_at = CURRENT_TIMESTAMP
    ";

            $stmt = $pdo->prepare($sql);
            $processed = 0;


            foreach ($vehicles as $vehicle) {

                if (!isset($vehicle['vehicleId'])) {
                    continue;
                }
        /*
        TEMPERATURE
        */

        $temperature = $vehicle['temperature'] ?? []; 
        $temperature1 = $temperature[0] ?? null;
        $temperature2 = $temperature[1] ?? null;
        $temperature3 = $temperature[2] ?? null;


        /*
        | DRIVER
        */

        $driverName =
            $vehicle['driver1']['fullname']
            ?? null;


        /*
        ADDRESS DETAIL
        */

        $addressDetail =
            $vehicle['addressDetail']
            ?? [];
        $province =
            $addressDetail['province']
            ?? null;
        $city =
            $addressDetail['city']
            ?? null;
        $district =
            $addressDetail['district']
            ?? null;

        /*
        | JSON FIELD
        */

        $geolocations = json_encode(
            $vehicle['geolocations'] ?? [],
            JSON_UNESCAPED_UNICODE
        );


        $vehicleGroups = json_encode(
            $vehicle['vehicleGroups'] ?? [],
            JSON_UNESCAPED_UNICODE
        );


        $batteryBle = json_encode(
            $vehicle['batteryBLE'] ?? [],
            JSON_UNESCAPED_UNICODE
        );


        /*
        INSERT / UPDATE
        */

        $stmt->execute([

            ':vehicle_id' =>
                $vehicle['vehicleId'] ?? null,

            ':company_id' =>
                $vehicle['companyId'] ?? null,

            ':company_name' =>
                $vehicle['companyName'] ?? null,


            ':driver_id' =>
                $vehicle['driverId'] ?? null,

            ':trip_driver_id' =>
                $vehicle['tripDriverId'] ?? null,

            ':driver_name' =>
                $driverName,


            ':license_plate' =>
                $vehicle['licensePlate'] ?? null,

            ':hull_no' =>
                $vehicle['hullNo'] ?? null,

            ':imei' =>
                $vehicle['imei'] ?? null,


            ':latitude' =>
                $vehicle['latitude'] ?? null,

            ':longitude' =>
                $vehicle['longitude'] ?? null,

            ':altitude' =>
                $vehicle['altitude'] ?? null,


            ':temperature_1' =>
                $temperature1,

            ':temperature_2' =>
                $temperature2,

            ':temperature_3' =>
                $temperature3,


            ':fuel' =>
                $vehicle['fuel'] ?? null,

            ':fuel_filtered' =>
                $vehicle['fuelFiltered'] ?? null,

            ':fuel_capacity' =>
                $vehicle['fuelCapacity'] ?? null,

            ':sum_fuel' =>
                $vehicle['sumFuel'] ?? null,

            ':trip_fuel' =>
                $vehicle['tripFuel'] ?? null,


            ':sum_distance' =>
                $vehicle['sumDistance'] ?? null,

            ':trip_distance' =>
                $vehicle['tripDistance'] ?? null,


            ':sum_drivetime' =>
                $vehicle['sumDrivetime'] ?? null,

            ':trip_drivetime' =>
                $vehicle['tripDrivetime'] ?? null,


            ':sum_drivetime_formatted' =>
                $vehicle['sumDrivetimeFormatted'] ?? null,

            ':trip_drivetime_formatted' =>
                $vehicle['tripDrivetimeFormatted'] ?? null,

            ':speed' =>
                $vehicle['speed'] ?? null,

            ':calculated_speed' =>
                $vehicle['calculatedSpeed'] ?? null,

            ':direction' =>
                $vehicle['direction'] ?? null,

            ':signal_strength' =>
                $vehicle['signalStrength'] ?? null,

            ':battery' =>
                $vehicle['battery'] ?? null,

            ':harsh_brakes' =>
                $vehicle['harshBrakes'] ?? null,

            ':harsh_accels' =>
                $vehicle['harshAccels'] ?? null,

            ':sharp_turns' =>
                $vehicle['sharpTurns'] ?? null,

            ':overspeeds' =>
                $vehicle['overspeeds'] ?? null,


            ':fence_ctr' =>
                $vehicle['fenceCtr'] ?? null,

            ':door1_status' =>
                $vehicle['door1Status'] ?? null,

            ':door2_status' =>
                $vehicle['door2Status'] ?? null,

            ':refrigerator_status' =>
                $vehicle['refrigeratorStatus'] ?? null,


            ':trip_maxspeed' =>
                $vehicle['tripMaxspeed'] ?? null,


            ':motion_status' =>
                $vehicle['motionStatus'] ?? null,

            ':calculated_motion_status' =>
                $vehicle['calculatedMotionStatus'] ?? null,

            ':engine_on' =>
                $vehicle['engineOn'] ?? null,

            ':battery_alarm_set' =>
                $vehicle['batteryAlarmSet'] ?? null,

            ':gsm_alarm_set' =>
                $vehicle['gsmAlarmSet'] ?? null,

            ':tripstart_on' =>
                toMysqlDatetime($vehicle['tripstartOn'] ?? null),

            ':tripstart_long' =>
                $vehicle['tripstartLong'] ?? null,

            ':tripstart_lat' =>
                $vehicle['tripstartLat'] ?? null,

            ':address' =>
                $vehicle['address'] ?? null,

            ':province' =>
                $province,

            ':city' =>
                $city,

            ':district' =>
                $district,

            ':geolocations' =>
                $geolocations,

            ':vehicle_groups' =>
                $vehicleGroups,

            ':battery_ble' =>
                $batteryBle,

            ':last_packet' =>
                toMysqlDatetime($vehicle['lastPacket'] ?? null),

            ':last_receive' =>
                toMysqlDatetime($vehicle['lastReceive'] ?? null),

            ':last_motion' =>
                toMysqlDatetime($vehicle['lastMotion'] ?? null),

            ':last_status_chg' =>
                toMysqlDatetime($vehicle['lastStatusChg'] ?? null),

            ':driver_change_on' =>
                toMysqlDatetime($vehicle['driverChangeOn'] ?? null),


            ':last_door1_data' =>
                toMysqlDatetime($vehicle['lastDoor1Data'] ?? null),

            ':last_door1_alert' =>
                toMysqlDatetime($vehicle['lastDoor1Alert'] ?? null),

            ':last_door2_alert' =>
                toMysqlDatetime($vehicle['lastDoor2Alert'] ?? null),

            ':last_speed_alert' =>
                toMysqlDatetime($vehicle['lastSpeedAlert'] ?? null),

            ':last_summary' =>
                toMysqlDatetime($vehicle['lastSummary'] ?? null),


            ':requested_date' =>
                toMysqlDatetime($vehicle['requestedDate'] ?? null)
        ]);

        $processed++;
    }

        $pdo->commit();

        echo json_encode([
            'success' => true,
            'message' => '200 Sync Easygo berhasil.',
            'total_vehicle' => $processed
        ], JSON_PRETTY_PRINT);


    } catch (Throwable $e) {

        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }


        http_response_code(500);


        echo json_encode([
            'success' => false,
            'message' => 'Sync Easygo gagal.',
            'error' => $e->getMessage()
        ], JSON_PRETTY_PRINT);
    }