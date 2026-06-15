create table areas
(
    id            bigint unsigned auto_increment
        primary key,
    nombre        varchar(255) not null,
    clave         varchar(255) not null,
    observaciones text         null,
    deleted_at    timestamp    null,
    created_at    timestamp    null,
    updated_at    timestamp    null,
    constraint areas_clave_deleted_at_unique
        unique (clave, deleted_at)
)
    collate = utf8mb4_unicode_ci;

create table cache
(
    `key`      varchar(255) not null
        primary key,
    value      mediumtext   not null,
    expiration bigint       not null
)
    collate = utf8mb4_unicode_ci;

create index cache_expiration_index
    on cache (expiration);

create table cache_locks
(
    `key`      varchar(255) not null
        primary key,
    owner      varchar(255) not null,
    expiration bigint       not null
)
    collate = utf8mb4_unicode_ci;

create index cache_locks_expiration_index
    on cache_locks (expiration);

create table carreras
(
    id         bigint unsigned auto_increment
        primary key,
    nombre     varchar(255) not null,
    deleted_at timestamp    null,
    created_at timestamp    null,
    updated_at timestamp    null
)
    collate = utf8mb4_unicode_ci;

create table edificios
(
    id         bigint unsigned auto_increment
        primary key,
    nombre     varchar(255) not null,
    deleted_at timestamp    null,
    created_at timestamp    null,
    updated_at timestamp    null
)
    collate = utf8mb4_unicode_ci;

create table failed_jobs
(
    id         bigint unsigned auto_increment
        primary key,
    uuid       varchar(255)                          not null,
    connection varchar(255)                          not null,
    queue      varchar(255)                          not null,
    payload    longtext                              not null,
    exception  longtext                              not null,
    failed_at  timestamp default current_timestamp() not null,
    constraint failed_jobs_uuid_unique
        unique (uuid)
)
    collate = utf8mb4_unicode_ci;

create index failed_jobs_connection_queue_failed_at_index
    on failed_jobs (connection, queue, failed_at);

create table job_batches
(
    id             varchar(255) not null
        primary key,
    name           varchar(255) not null,
    total_jobs     int          not null,
    pending_jobs   int          not null,
    failed_jobs    int          not null,
    failed_job_ids longtext     not null,
    options        mediumtext   null,
    cancelled_at   int          null,
    created_at     int          not null,
    finished_at    int          null
)
    collate = utf8mb4_unicode_ci;

create table jobs
(
    id           bigint unsigned auto_increment
        primary key,
    queue        varchar(255)      not null,
    payload      longtext          not null,
    attempts     smallint unsigned not null,
    reserved_at  int unsigned      null,
    available_at int unsigned      not null,
    created_at   int unsigned      not null
)
    collate = utf8mb4_unicode_ci;

create index jobs_queue_index
    on jobs (queue);

create table migrations
(
    id        int unsigned auto_increment
        primary key,
    migration varchar(255) not null,
    batch     int          not null
)
    collate = utf8mb4_unicode_ci;

create table password_reset_tokens
(
    email      varchar(255) not null
        primary key,
    token      varchar(255) not null,
    created_at timestamp    null
)
    collate = utf8mb4_unicode_ci;

create table personal_access_tokens
(
    id             bigint unsigned auto_increment
        primary key,
    tokenable_type varchar(255)    not null,
    tokenable_id   bigint unsigned not null,
    name           text            not null,
    token          varchar(64)     not null,
    abilities      text            null,
    last_used_at   timestamp       null,
    expires_at     timestamp       null,
    created_at     timestamp       null,
    updated_at     timestamp       null,
    constraint personal_access_tokens_token_unique
        unique (token)
)
    collate = utf8mb4_unicode_ci;

create index personal_access_tokens_expires_at_index
    on personal_access_tokens (expires_at);

create index personal_access_tokens_tokenable_type_tokenable_id_index
    on personal_access_tokens (tokenable_type, tokenable_id);

create table planes_estudio
(
    id              bigint unsigned auto_increment
        primary key,
    nombre          varchar(255) not null,
    periodo_inicial date         not null,
    periodo_final   date         not null,
    deleted_at      timestamp    null,
    created_at      timestamp    null,
    updated_at      timestamp    null
)
    collate = utf8mb4_unicode_ci;

create table profesores
(
    id         bigint unsigned auto_increment
        primary key,
    nombre     varchar(255)    not null,
    email      varchar(255)    not null,
    area_id    bigint unsigned not null,
    deleted_at timestamp       null,
    created_at timestamp       null,
    updated_at timestamp       null,
    constraint profesores_email_deleted_at_unique
        unique (email, deleted_at),
    constraint profesores_area_id_foreign
        foreign key (area_id) references areas (id)
            on delete cascade
)
    collate = utf8mb4_unicode_ci;

create table salones
(
    id          bigint unsigned auto_increment
        primary key,
    nombre      varchar(255)    not null,
    edificio_id bigint unsigned not null,
    deleted_at  timestamp       null,
    created_at  timestamp       null,
    updated_at  timestamp       null,
    constraint salones_edificio_id_foreign
        foreign key (edificio_id) references edificios (id)
            on delete cascade
)
    collate = utf8mb4_unicode_ci;

create table sessions
(
    id            varchar(255)    not null
        primary key,
    user_id       bigint unsigned null,
    ip_address    varchar(45)     null,
    user_agent    text            null,
    payload       longtext        not null,
    last_activity int             not null
)
    collate = utf8mb4_unicode_ci;

create index sessions_last_activity_index
    on sessions (last_activity);

create index sessions_user_id_index
    on sessions (user_id);

create table unidades_aprendizaje
(
    id              bigint unsigned auto_increment
        primary key,
    nombre          varchar(255)     not null,
    semestre        tinyint unsigned null,
    carrera_id      bigint unsigned  not null,
    plan_estudio_id bigint unsigned  not null,
    deleted_at      timestamp        null,
    created_at      timestamp        null,
    updated_at      timestamp        null,
    constraint unidades_aprendizaje_carrera_id_foreign
        foreign key (carrera_id) references carreras (id)
            on delete cascade,
    constraint unidades_aprendizaje_plan_estudio_id_foreign
        foreign key (plan_estudio_id) references planes_estudio (id)
            on delete cascade
)
    collate = utf8mb4_unicode_ci;

create index unidades_aprendizaje_plan_estudio_id_index
    on unidades_aprendizaje (plan_estudio_id);

create index unidades_aprendizaje_plan_estudio_id_semestre_index
    on unidades_aprendizaje (plan_estudio_id, semestre);

create table users
(
    id                bigint unsigned auto_increment
        primary key,
    name              varchar(255)                  not null,
    email             varchar(255)                  not null,
    identificador     varchar(255)                  null,
    email_verified_at timestamp                     null,
    password          varchar(255)                  not null,
    rol               varchar(255) default 'alumno' not null,
    remember_token    varchar(100)                  null,
    deleted_at        timestamp                     null,
    created_at        timestamp                     null,
    updated_at        timestamp                     null,
    constraint users_email_deleted_at_unique
        unique (email, deleted_at),
    constraint users_identificador_deleted_at_unique
        unique (identificador, deleted_at)
)
    collate = utf8mb4_unicode_ci;

create table examenes
(
    id                    bigint unsigned auto_increment
        primary key,
    descripcion           varchar(255)         not null,
    horario               datetime             not null,
    activo                tinyint(1) default 1 not null,
    user_id               bigint unsigned      not null,
    unidad_aprendizaje_id bigint unsigned      not null,
    profesor_id           bigint unsigned      not null,
    salon_id              bigint unsigned      not null,
    deleted_at            timestamp            null,
    created_at            timestamp            null,
    updated_at            timestamp            null,
    constraint examenes_profesor_id_foreign
        foreign key (profesor_id) references profesores (id)
            on delete cascade,
    constraint examenes_salon_id_foreign
        foreign key (salon_id) references salones (id)
            on delete cascade,
    constraint examenes_unidad_aprendizaje_id_foreign
        foreign key (unidad_aprendizaje_id) references unidades_aprendizaje (id)
            on delete cascade,
    constraint examenes_user_id_foreign
        foreign key (user_id) references users (id)
            on delete cascade
)
    collate = utf8mb4_unicode_ci;

create table alumno_examen
(
    user_id    bigint unsigned not null,
    examen_id  bigint unsigned not null,
    created_at timestamp       null,
    updated_at timestamp       null,
    primary key (user_id, examen_id),
    constraint alumno_examen_examen_id_foreign
        foreign key (examen_id) references examenes (id)
            on delete cascade,
    constraint alumno_examen_user_id_foreign
        foreign key (user_id) references users (id)
            on delete cascade
)
    collate = utf8mb4_unicode_ci;


