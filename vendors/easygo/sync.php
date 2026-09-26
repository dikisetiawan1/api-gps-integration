<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/get_data.php';

header('Content-Type: application/json; charset=utf-8');

try {

    // Ambil data dari API Easygo
    $response = getEasygoData();

        if (
          !isset($response['Data']) ||
          !is_array($response['Data'])
      ) {
          throw new Exception('Data kendaraan Easygo tidak ditemukan.');
      }


      if (
        !isset($response['Data']) ||
        !is_array($response['Data'])
    ) {
        throw new Exception(
            'Data kendaraan Easygo tidak ditemukan.'
        );
    }

    $vehicles = $response['Data'];
    $pdo->beginTransaction();

    /*
            UPSERT DATA KE DATABASE 
    */

    $sql = "INSERT INTO tbl_easygo (
            acc,
            addr,
            alarm_nm,
            battery_percent,
            car_model,
            car_type,
            company_nm,
            altitude,
            currentDO,
            currentGeoAreaStatus,
            currentGeoLocationStatus,
            currentStatusVehicle_status,
            currentStatusVehicle_status_ket,
            currentStatusVehicle_driving,
            currentStatusVehicle_parking,
            currentStatusVehicle_idle_start_time,
            currentStatusVehicle_idle_stop_time,
            currentStatusVehicle_idle_duration_value,
            currentStatusVehicle_idle_duration_text,
            currentStatusVehicle_idle_lon,
            currentStatusVehicle_idle_lat,
            currentStatusVehicle_idle_addr,
            currentStatusVehicle_idle_geo_location_id,
            currentStatusVehicle_idle_geo_area_id,
            currentStatusVehicle_idle_geo_location_nm,
            currentStatusVehicle_idle_geo_area_nm,
            currentStatusVehicle_idle_geo_location_code,
            currentStatusVehicle_idle_geo_area_code,
            currentStatusVehicle_idle_fuel_consumption,
            currentStatusVehicle_rfid_driver_value,
            currentStatusVehicle_rfid_driver_text,
            direction,
            driver_nm,
            gps_satelit,
            gps_sn,
            gps_time,
            group_nm,
            gsm_no,
            gsm_signal,
            is_alarm,
            kec,
            kode_pos,
            kota,
            lat,
            lon,
            main_power_voltage,
            nopol,
            no_aset,
            odometer,
            over_speed_status,
            provinsi,
            report_nm,
            sos,
            speed,
            stime,
            temperatur1,
            temperatur2,
            totalkm_mtd_total_km,
            totalkm_mtd_max_speed,
            totalkm_mtd_avg_speed,
            totalkm_mtd_start_date_counting,
            totalkm_mtd_dur_moving,
            totalkm_mtd_dur_mov2,
            totalkm_today_total_km,
            totalkm_today_max_speed,
            totalkm_today_avg_speed,
            totalkm_today_start_date_counting,
            totalkm_today_dur_moving,
            totalkm_today_dur_mov2,
            totalkm_ytd_total_km,
            totalkm_ytd_max_speed,
            totalkm_ytd_avg_speed,
            totalkm_ytd_start_date_counting,
            totalkm_ytd_dur_moving,
            totalkm_ytd_dur_mov2

        ) VALUES (
            :acc,
            :addr,
            :alarm_nm,
            :battery_percent,
            :car_model,
            :car_type,
            :company_nm,
            :altitude,
            :currentDO,
            :currentGeoAreaStatus,
            :currentGeoLocationStatus,
            :currentStatusVehicle_status,
            :currentStatusVehicle_status_ket,
            :currentStatusVehicle_driving,
            :currentStatusVehicle_parking,
            :currentStatusVehicle_idle_start_time,
            :currentStatusVehicle_idle_stop_time,
            :currentStatusVehicle_idle_duration_value,
            :currentStatusVehicle_idle_duration_text,
            :currentStatusVehicle_idle_lon,
            :currentStatusVehicle_idle_lat,
            :currentStatusVehicle_idle_addr,
            :currentStatusVehicle_idle_geo_location_id,
            :currentStatusVehicle_idle_geo_area_id,
            :currentStatusVehicle_idle_geo_location_nm,
            :currentStatusVehicle_idle_geo_area_nm,
            :currentStatusVehicle_idle_geo_location_code,
            :currentStatusVehicle_idle_geo_area_code,
            :currentStatusVehicle_idle_fuel_consumption,
            :currentStatusVehicle_rfid_driver_value,
            :currentStatusVehicle_rfid_driver_text,
            :direction,
            :driver_nm,
            :gps_satelit,
            :gps_sn,
            :gps_time,
            :group_nm,
            :gsm_no,
            :gsm_signal,
            :is_alarm,
            :kec,
            :kode_pos,
            :kota,
            :lat,
            :lon,
            :main_power_voltage,
            :nopol,
            :no_aset,
            :odometer,
            :over_speed_status,
            :provinsi,
            :report_nm,
            :sos,
            :speed,
            :stime,
            :temperatur1,
            :temperatur2,
            :totalkm_mtd_total_km,
            :totalkm_mtd_max_speed,
            :totalkm_mtd_avg_speed,
            :totalkm_mtd_start_date_counting,
            :totalkm_mtd_dur_moving,
            :totalkm_mtd_dur_mov2,
            :totalkm_today_total_km,
            :totalkm_today_max_speed,
            :totalkm_today_avg_speed,
            :totalkm_today_start_date_counting,
            :totalkm_today_dur_moving,
            :totalkm_today_dur_mov2,
            :totalkm_ytd_total_km,
            :totalkm_ytd_max_speed,
            :totalkm_ytd_avg_speed,
            :totalkm_ytd_start_date_counting,
            :totalkm_ytd_dur_moving,
            :totalkm_ytd_dur_mov2
            
            ) 

            ON DUPLICATE KEY UPDATE
            acc = VALUES(acc),
            addr = VALUES(addr),
            alarm_nm = VALUES(alarm_nm),
            battery_percent = VALUES(battery_percent),
            car_model = VALUES(car_model),
            car_type = VALUES(car_type),
            company_nm = VALUES(company_nm),
            altitude = VALUES(altitude),
            currentDO = VALUES(currentDO),
            currentGeoAreaStatus = VALUES(currentGeoAreaStatus),
            currentGeoLocationStatus = VALUES(currentGeoLocationStatus),
            currentStatusVehicle_status = VALUES(currentStatusVehicle_status),
            currentStatusVehicle_status_ket = VALUES(currentStatusVehicle_status_ket),
            currentStatusVehicle_driving = VALUES(currentStatusVehicle_driving),
            currentStatusVehicle_parking = VALUES(currentStatusVehicle_parking),
            currentStatusVehicle_idle_start_time = VALUES(currentStatusVehicle_idle_start_time),
            currentStatusVehicle_idle_stop_time = VALUES(currentStatusVehicle_idle_stop_time),
            currentStatusVehicle_idle_duration_value = VALUES(currentStatusVehicle_idle_duration_value),
            currentStatusVehicle_idle_duration_text = VALUES(currentStatusVehicle_idle_duration_text),
            currentStatusVehicle_idle_lon = VALUES(currentStatusVehicle_idle_lon),
            currentStatusVehicle_idle_lat = VALUES(currentStatusVehicle_idle_lat),
            currentStatusVehicle_idle_addr = VALUES(currentStatusVehicle_idle_addr),
            currentStatusVehicle_idle_geo_location_id = VALUES(currentStatusVehicle_idle_geo_location_id),
            currentStatusVehicle_idle_geo_area_id = VALUES(currentStatusVehicle_idle_geo_area_id),
            currentStatusVehicle_idle_geo_location_nm = VALUES(currentStatusVehicle_idle_geo_location_nm),
            currentStatusVehicle_idle_geo_area_nm = VALUES(currentStatusVehicle_idle_geo_area_nm),
            currentStatusVehicle_idle_geo_location_code = VALUES(currentStatusVehicle_idle_geo_location_code),
            currentStatusVehicle_idle_geo_area_code = VALUES(currentStatusVehicle_idle_geo_area_code),
            currentStatusVehicle_idle_fuel_consumption = VALUES(currentStatusVehicle_idle_fuel_consumption),
            currentStatusVehicle_rfid_driver_value = VALUES(currentStatusVehicle_rfid_driver_value),
            currentStatusVehicle_rfid_driver_text = VALUES(currentStatusVehicle_rfid_driver_text),
            direction = VALUES(direction),
            driver_nm = VALUES(driver_nm),
            gps_satelit = VALUES(gps_satelit),
            gps_sn = VALUES(gps_sn),
            gps_time = VALUES(gps_time),
            group_nm = VALUES(group_nm),
            gsm_no = VALUES(gsm_no),
            gsm_signal = VALUES(gsm_signal),
            is_alarm = VALUES(is_alarm),
            kec = VALUES(kec),
            kode_pos = VALUES(kode_pos),
            kota = VALUES(kota),
            lat = VALUES(lat),
            lon = VALUES(lon),
            main_power_voltage = VALUES(main_power_voltage),
            nopol = VALUES(nopol),
            no_aset = VALUES(no_aset),
            odometer = VALUES(odometer),
            over_speed_status = VALUES(over_speed_status),
            provinsi = VALUES(provinsi),
            report_nm = VALUES(report_nm),
            sos = VALUES(sos),
            speed = VALUES(speed),
            stime = VALUES(stime),
            temperatur1 = VALUES(temperatur1),
            temperatur2 = VALUES(temperatur2),
            totalkm_mtd_total_km = VALUES(totalkm_mtd_total_km),
            totalkm_mtd_max_speed = VALUES(totalkm_mtd_max_speed),
            totalkm_mtd_avg_speed = VALUES(totalkm_mtd_avg_speed),
            totalkm_mtd_start_date_counting = VALUES(totalkm_mtd_start_date_counting),
            totalkm_mtd_dur_moving = VALUES(totalkm_mtd_dur_moving),
            totalkm_mtd_dur_mov2 = VALUES(totalkm_mtd_dur_mov2),
            totalkm_today_total_km = VALUES(totalkm_today_total_km),
            totalkm_today_max_speed = VALUES(totalkm_today_max_speed),
            totalkm_today_avg_speed = VALUES(totalkm_today_avg_speed),
            totalkm_today_start_date_counting = VALUES(totalkm_today_start_date_counting),
            totalkm_today_dur_moving = VALUES(totalkm_today_dur_moving),
            totalkm_today_dur_mov2 = VALUES(totalkm_today_dur_mov2),
            totalkm_ytd_total_km = VALUES(totalkm_ytd_total_km),
            totalkm_ytd_max_speed = VALUES(totalkm_ytd_max_speed),
            totalkm_ytd_avg_speed = VALUES(totalkm_ytd_avg_speed),
            totalkm_ytd_start_date_counting = VALUES(totalkm_ytd_start_date_counting),
            totalkm_ytd_dur_moving = VALUES(totalkm_ytd_dur_moving),
            totalkm_ytd_dur_mov2 = VALUES(totalkm_ytd_dur_mov2)
        ";

            $stmt = $pdo->prepare($sql);
            $processed = 0;

            foreach ($vehicles as $vehicle) {

                if (!isset($vehicle['nopol'])) {
                    continue;
                }
                
            $status = $vehicle['currentStatusVehicle'] ?? [];
            $idle = $status['idle'] ?? [];
            $rfid = $status['rfid_driver'] ?? [];

            $mtd = $vehicle['totalkm_mtd'] ?? [];
            $today = $vehicle['totalkm_today'] ?? [];
            $ytd = $vehicle['totalkm_ytd'] ?? [];

            $driving = $status['driving'] ?? null;
            $parking = $status['parking'] ?? null;
            $moving  = $status['moving'] ?? null;

            $stmt->execute([
                ':acc' => $vehicle['acc'] ?? null,
                ':addr' => is_array($vehicle['addr'] ?? null) ? json_encode($vehicle['addr'], JSON_UNESCAPED_UNICODE) : ($vehicle['addr'] ?? null),
                ':alarm_nm' => $vehicle['alarm_nm'] ?? null,
                ':battery_percent' => $vehicle['battery_percent'] ?? null,
                ':car_model' => $vehicle['car_model'] ?? null,
                ':car_type' => $vehicle['car_type'] ?? null,
                ':company_nm' => $vehicle['company_nm'] ?? null,
                ':altitude' => $vehicle['altitude'] ?? null,
                ':currentDO' => $vehicle['currentDO'] ?? null,
                ':currentGeoAreaStatus' => is_array($vehicle['currentGeoAreaStatus'] ?? null) ? json_encode($vehicle['currentGeoAreaStatus'], JSON_UNESCAPED_UNICODE): ($vehicle['currentGeoAreaStatus'] ?? null),
                ':currentGeoLocationStatus' => is_array($vehicle['currentGeoLocationStatus'] ?? null) ? json_encode($vehicle['currentGeoLocationStatus'], JSON_UNESCAPED_UNICODE): ($vehicle['currentGeoLocationStatus'] ?? null),
                ':currentStatusVehicle_status' => is_array($status['status'] ?? null) ? json_encode($status['status'], JSON_UNESCAPED_UNICODE): ($status['status'] ?? null),
                ':currentStatusVehicle_status_ket' => is_array($status['ket'] ?? null) ? json_encode($status['ket'], JSON_UNESCAPED_UNICODE): ($status['ket'] ?? null),
                ':currentStatusVehicle_driving' => is_array($status['driving'] ?? null)? json_encode($status['driving'], JSON_UNESCAPED_UNICODE):($status['driving'] ?? null),
                ':currentStatusVehicle_parking' => is_array($status['parking'] ?? null) ? json_encode($status['parking'], JSON_UNESCAPED_UNICODE):($status['parking'] ?? null),
                ':currentStatusVehicle_idle_start_time' => $idle['start_time'] ?? null,
                ':currentStatusVehicle_idle_stop_time' => $idle['stop_time'] ?? null,
                ':currentStatusVehicle_idle_duration_value' => $idle['duration']['value'] ?? null,
                ':currentStatusVehicle_idle_duration_text' => $idle['duration']['text'] ?? null,
                ':currentStatusVehicle_idle_lon' => $idle['lon'] ?? null,
                ':currentStatusVehicle_idle_lat' => $idle['lat'] ?? null,
                ':currentStatusVehicle_idle_addr' => $idle['addr'] ?? null,
                ':currentStatusVehicle_idle_geo_location_id' => $idle['geo_location_id'] ?? null,
                ':currentStatusVehicle_idle_geo_area_id' => $idle['geo_area_id'] ?? null,
                ':currentStatusVehicle_idle_geo_location_nm' => $idle['geo_location_nm'] ?? null,
                ':currentStatusVehicle_idle_geo_area_nm' => $idle['geo_area_nm'] ?? null,
                ':currentStatusVehicle_idle_geo_location_code' => $idle['geo_location_code'] ?? null,
                ':currentStatusVehicle_idle_geo_area_code' => $idle['geo_area_code'] ?? null,
                ':currentStatusVehicle_idle_fuel_consumption' => $idle['fuel_consumption'] ?? null,
                ':currentStatusVehicle_rfid_driver_value' => $rfid['value'] ?? null,
                ':currentStatusVehicle_rfid_driver_text' => $rfid['text'] ?? null,
                ':direction' => $vehicle['direction'] ?? null,
                ':driver_nm' => $vehicle['driver_nm'] ?? null,
                ':gps_satelit' => $vehicle['gps_satelit'] ?? null,
                ':gps_sn' => $vehicle['gps_sn'] ?? null,
                ':gps_time' => $vehicle['gps_time'] ?? null,
                ':group_nm' => $vehicle['group_nm'] ?? null,
                ':gsm_no' => $vehicle['gsm_no'] ?? null,
                ':gsm_signal' => $vehicle['gsm_signal'] ?? null,
                ':is_alarm' => $vehicle['is_alarm'] ?? null,
                ':kec' => $vehicle['kec'] ?? null,
                ':kode_pos' => $vehicle['kode_pos'] ?? null,
                ':kota' => $vehicle['kota'] ?? null,
                ':lat' => $vehicle['lat'] ?? null,
                ':lon' => $vehicle['lon'] ?? null,
                ':main_power_voltage' => $vehicle['main_power_voltage'] ?? null,
                ':nopol' => $vehicle['nopol'] ?? null,
                ':no_aset' => $vehicle['no_aset'] ?? null,
                ':odometer' => $vehicle['odometer'] ?? null,
                ':over_speed_status' => $vehicle['overSpeedStatus'] ?? null,
                ':provinsi' => $vehicle['provinsi'] ?? null,
                ':report_nm' => $vehicle['report_nm'] ?? null,
                ':sos' => $vehicle['sos'] ?? null,
                ':speed' => $vehicle['speed'] ?? null,
                ':stime' => $vehicle['stime'] ?? null,
                ':temperatur1' => $vehicle['temperatur1'] ?? null,
                ':temperatur2' => $vehicle['temperatur2'] ?? null,
                ':totalkm_mtd_total_km' => $mtd['total_km'] ?? null,
                ':totalkm_mtd_max_speed' => $mtd['max_speed'] ?? null,
                ':totalkm_mtd_avg_speed' => $mtd['avg_speed'] ?? null,
                ':totalkm_mtd_start_date_counting' => $mtd['start_date_counting'] ?? null,
                ':totalkm_mtd_dur_moving' => $mtd['dur_moving'] ?? null,
                ':totalkm_mtd_dur_mov2' => $mtd['durMov2'] ?? null,
                ':totalkm_today_total_km' => $today['total_km'] ?? null,
                ':totalkm_today_max_speed' => $today['max_speed'] ?? null,
                ':totalkm_today_avg_speed' => $today['avg_speed'] ?? null,
                ':totalkm_today_start_date_counting' => $today['start_date_counting'] ?? null,
                ':totalkm_today_dur_moving' => $today['dur_moving'] ?? null,
                ':totalkm_today_dur_mov2' => $today['durMov2'] ?? null,
                ':totalkm_ytd_total_km' => $ytd['total_km'] ?? null,
                ':totalkm_ytd_max_speed' => $ytd['max_speed'] ?? null,
                ':totalkm_ytd_avg_speed' => $ytd['avg_speed'] ?? null,
                ':totalkm_ytd_start_date_counting' => $ytd['start_date_counting'] ?? null,
                ':totalkm_ytd_dur_moving' => $ytd['dur_moving'] ?? null,
                ':totalkm_ytd_dur_mov2' => $ytd['durMov2'] ?? null
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