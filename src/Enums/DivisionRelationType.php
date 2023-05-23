<?php

namespace Reprover\Jeepay\Enums;

/**
 * 分账关系类型：
 * SERVICE_PROVIDER：服务商
 * STORE：门店
 * STAFF：员工
 * STORE_OWNER：店主
 * PARTNER：合作伙伴
 * HEADQUARTER：总部
 * BRAND：品牌方
 * DISTRIBUTOR：分销商
 * USER：用户
 * SUPPLIER：供应商
 * CUSTOM：自定义
 */
enum DivisionRelationType: string
{
    case SERVICE_PROVIDER = 'SERVICE_PROVIDER';
    case STORE = 'STORE';
    case STAFF = 'STAFF';
    case STORE_OWNER = 'STORE_OWNER';
    case PARTNER = 'PARTNER';
    case HEADQUARTER = 'HEADQUARTER';
    case BRAND = 'BRAND';
    case DISTRIBUTOR = 'DISTRIBUTOR';
    case USER = 'USER';
    case SUPPLIER = 'SUPPLIER';
    case CUSTOM = 'CUSTOM';
}
