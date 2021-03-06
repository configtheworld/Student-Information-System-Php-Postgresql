PGDMP         -                 y            STUDENT    13.1    13.1     �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
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
       public          postgres    false    202            �           0    0    course_course_id_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.course_course_id_seq OWNED BY public.course.course_id;
          public          postgres    false    203            �            1259    16436 
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
       public          postgres    false    204            �           0    0    enrollment_enrollment_id_seq    SEQUENCE OWNED BY     ]   ALTER SEQUENCE public.enrollment_enrollment_id_seq OWNED BY public.enrollment.enrollment_id;
          public          postgres    false    205            �            1259    16409    student    TABLE       CREATE TABLE public.student (
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
          public          postgres    false    201            0           2604    16432    course course_id    DEFAULT     t   ALTER TABLE ONLY public.course ALTER COLUMN course_id SET DEFAULT nextval('public.course_course_id_seq'::regclass);
 ?   ALTER TABLE public.course ALTER COLUMN course_id DROP DEFAULT;
       public          postgres    false    203    202            1           2604    16441    enrollment enrollment_id    DEFAULT     �   ALTER TABLE ONLY public.enrollment ALTER COLUMN enrollment_id SET DEFAULT nextval('public.enrollment_enrollment_id_seq'::regclass);
 G   ALTER TABLE public.enrollment ALTER COLUMN enrollment_id DROP DEFAULT;
       public          postgres    false    205    204            /           2604    16425 
   student id    DEFAULT     h   ALTER TABLE ONLY public.student ALTER COLUMN id SET DEFAULT nextval('public.student_id_seq'::regclass);
 9   ALTER TABLE public.student ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    201    200            �          0    16427    course 
   TABLE DATA           L   COPY public.course (coursename, department, lecture, course_id) FROM stdin;
    public          postgres    false    202   b       �          0    16436 
   enrollment 
   TABLE DATA           J   COPY public.enrollment (coursename, enrollment_id, studentno) FROM stdin;
    public          postgres    false    204          �          0    16409    student 
   TABLE DATA           a   COPY public.student (id, fullname, department, year, password, studentno, user_type) FROM stdin;
    public          postgres    false    200   �       �           0    0    course_course_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.course_course_id_seq', 12, true);
          public          postgres    false    203            �           0    0    enrollment_enrollment_id_seq    SEQUENCE SET     K   SELECT pg_catalog.setval('public.enrollment_enrollment_id_seq', 43, true);
          public          postgres    false    205            �           0    0    student_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.student_id_seq', 22, true);
          public          postgres    false    201            �   �   x�}Ͻ
�@�z�)�	-�iE�$��%.G�ݸw����b��N��c�ܸ��H�rÃv��%{Z�(����O>U�L��Øa	Q ��F�͗P�!|����6�֝��'�YS�t��ts�al�p���H���,u3����@�e4��j�^K.t>�\���9�3Q�      �   �   x�}ν�0���)��?Ж�ɉ8�T��M�������|99�S��@:�+[+���.�8f�'~�.�9�2��>,leT��#^��@5������ۉrHH��(x�'�%�����h���lj[�)�ߘh�A�۾�F����{hfS      �   �  x����n�0��;v���HJ<ݮ{�^(K�6I�&���ݭ�!ɐ> ?��D��X�}�ۮ�����m�ڴ�[m���rs�H��s���	8����w-f�@smu�px�͙��c5%��s5_P}#@�uJ���A,+�f���w���{\�'��3���5��d�N�q�S4]��|d5�N��f!u7�R�!4��=gG^@��3�>�迮&�b�I;�����Jccjӄ��I-���� P�A���5\�1�K�L*1/cD��8SZ��G9�������齗/���j��?Զ�ȯ��*7�����f�#����+��cV����}N���I�hz����-��AIE�&*]t�g�P=�W��z���$:e��Tͥ�*x-\�9N �8k'�Rڙ�t������;���(���������e��� ����E�lˉX8ZM�X�
���P� �e��h�o�������.     