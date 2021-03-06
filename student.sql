PGDMP     0                     y            STUDENT    13.1    13.1     �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    16408    STUDENT    DATABASE     m   CREATE DATABASE "STUDENT" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'English_United States.1252';
    DROP DATABASE "STUDENT";
                postgres    false            �            1259    16427    course    TABLE     �   CREATE TABLE public.course (
    coursename character varying(100),
    department character varying(100),
    lecture character varying(100) COLLATE pg_catalog."tr-TR-x-icu",
    course_id integer NOT NULL
);
    DROP TABLE public.course;
       public         heap    postgres    false            �            1259    16430    course_course_id_seq    SEQUENCE     �   CREATE SEQUENCE public.course_course_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.course_course_id_seq;
       public          postgres    false    204            �           0    0    course_course_id_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.course_course_id_seq OWNED BY public.course.course_id;
          public          postgres    false    205            �            1259    16436 
   enrollment    TABLE     �   CREATE TABLE public.enrollment (
    coursename character varying(100),
    enrollment_id integer NOT NULL,
    studentno character varying(100)
);
    DROP TABLE public.enrollment;
       public         heap    postgres    false            �            1259    16439    enrollment_enrollment_id_seq    SEQUENCE     �   CREATE SEQUENCE public.enrollment_enrollment_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 3   DROP SEQUENCE public.enrollment_enrollment_id_seq;
       public          postgres    false    206            �           0    0    enrollment_enrollment_id_seq    SEQUENCE OWNED BY     ]   ALTER SEQUENCE public.enrollment_enrollment_id_seq OWNED BY public.enrollment.enrollment_id;
          public          postgres    false    207            �            1259    16409    student    TABLE       CREATE TABLE public.student (
    id integer NOT NULL,
    fullname character varying NOT NULL,
    department character varying NOT NULL,
    year integer NOT NULL,
    password character varying NOT NULL,
    studentno integer NOT NULL,
    user_type character varying(50)
);
    DROP TABLE public.student;
       public         heap    postgres    false            �            1259    16415    student_id_seq    SEQUENCE     �   CREATE SEQUENCE public.student_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.student_id_seq;
       public          postgres    false    200            �           0    0    student_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.student_id_seq OWNED BY public.student.id;
          public          postgres    false    201            �            1259    16417    users    TABLE     �  CREATE TABLE public.users (
    id integer NOT NULL,
    fullname character varying(100)[] COLLATE pg_catalog."tr-TR-x-icu",
    department character varying(100)[] COLLATE pg_catalog."tr-TR-x-icu",
    yil integer,
    created date,
    password character varying(100) NOT NULL COLLATE pg_catalog."tr-TR-x-icu",
    courses text[] COLLATE pg_catalog."tr-TR-x-icu",
    studentno integer NOT NULL
);
    DROP TABLE public.users;
       public         heap    postgres    false            �            1259    16423    users_id_seq    SEQUENCE     �   CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public          postgres    false    202            �           0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
          public          postgres    false    203            8           2604    16432    course course_id    DEFAULT     t   ALTER TABLE ONLY public.course ALTER COLUMN course_id SET DEFAULT nextval('public.course_course_id_seq'::regclass);
 ?   ALTER TABLE public.course ALTER COLUMN course_id DROP DEFAULT;
       public          postgres    false    205    204            9           2604    16441    enrollment enrollment_id    DEFAULT     �   ALTER TABLE ONLY public.enrollment ALTER COLUMN enrollment_id SET DEFAULT nextval('public.enrollment_enrollment_id_seq'::regclass);
 G   ALTER TABLE public.enrollment ALTER COLUMN enrollment_id DROP DEFAULT;
       public          postgres    false    207    206            6           2604    16425 
   student id    DEFAULT     h   ALTER TABLE ONLY public.student ALTER COLUMN id SET DEFAULT nextval('public.student_id_seq'::regclass);
 9   ALTER TABLE public.student ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    201    200            7           2604    16426    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    203    202            �          0    16427    course 
   TABLE DATA           L   COPY public.course (coursename, department, lecture, course_id) FROM stdin;
    public          postgres    false    204   |       �          0    16436 
   enrollment 
   TABLE DATA           J   COPY public.enrollment (coursename, enrollment_id, studentno) FROM stdin;
    public          postgres    false    206          �          0    16409    student 
   TABLE DATA           a   COPY public.student (id, fullname, department, year, password, studentno, user_type) FROM stdin;
    public          postgres    false    200   W       �          0    16417    users 
   TABLE DATA           e   COPY public.users (id, fullname, department, yil, created, password, courses, studentno) FROM stdin;
    public          postgres    false    202   �        �           0    0    course_course_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.course_course_id_seq', 10, true);
          public          postgres    false    205            �           0    0    enrollment_enrollment_id_seq    SEQUENCE SET     K   SELECT pg_catalog.setval('public.enrollment_enrollment_id_seq', 26, true);
          public          postgres    false    207            �           0    0    student_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.student_id_seq', 17, true);
          public          postgres    false    201            �           0    0    users_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.users_id_seq', 1, false);
          public          postgres    false    203            �      x�}�;�0E�Z^�V@ɧ���h����8HF���3t�=s;'�A��7]A=�G:�"ή|�[��JsJ�l�a�E +�	V���˯x��?᧞�:�ii��'����y�y�(�`���!���B{      �   <   x�K,NI,N�42�4�0461752���#�d�(��+x%�%'e�p�!I��qqq �,      �   x  x���Mn1��]���$.��۞ �H���.��W3Fa (����I��?���v۟�C��6o����4oBLa[���1��%G���w񿳘� .Y
e�9��|%�uwN�dJ�����(Z�D<bY��U��KM\ߙ��e�(�:�gƱ�\L2{��0�LW1Q�GQC��K`�,Q�MH
B''��y9�,`�7�W��L
dEZH�:c���5Ʊ�#ZeL&�7VP!�D��ؾ��.�����`R��ֈ�.�q�i-�U��\���kz}��z�L5cx;K��	]G��%6��e;�]�����γj8�^<�k�'�pF�i�oo<��W��%�MtooRQ=�	������?��uX      �      x������ � �     