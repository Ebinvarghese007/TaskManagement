--
-- PostgreSQL database dump
--

-- Dumped from database version 16.1
-- Dumped by pg_dump version 16.1

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: tbl_users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_users (
    user_id integer NOT NULL,
    user_name character varying(100) NOT NULL,
    user_email character varying(150) NOT NULL,
    user_password text NOT NULL,
    is_active boolean DEFAULT true,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.tbl_users OWNER TO postgres;

--
-- Name: tbl_users_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_users_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.tbl_users_user_id_seq OWNER TO postgres;

--
-- Name: tbl_users_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_users_user_id_seq OWNED BY public.tbl_users.user_id;


--
-- Name: user_tasks; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.user_tasks (
    task_id integer NOT NULL,
    user_id integer NOT NULL,
    task_name character varying(255) NOT NULL,
    task_priority character varying(50) NOT NULL,
    task_due_date date NOT NULL,
    task_created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    task_updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    task_status character varying(20) DEFAULT 'pending'::character varying
);


ALTER TABLE public.user_tasks OWNER TO postgres;

--
-- Name: user_tasks_task_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.user_tasks_task_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.user_tasks_task_id_seq OWNER TO postgres;

--
-- Name: user_tasks_task_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.user_tasks_task_id_seq OWNED BY public.user_tasks.task_id;


--
-- Name: tbl_users user_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_users ALTER COLUMN user_id SET DEFAULT nextval('public.tbl_users_user_id_seq'::regclass);


--
-- Name: user_tasks task_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_tasks ALTER COLUMN task_id SET DEFAULT nextval('public.user_tasks_task_id_seq'::regclass);


--
-- Data for Name: tbl_users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tbl_users (user_id, user_name, user_email, user_password, is_active, created_at, updated_at) FROM stdin;
9	mariya	mariya@gmail.com	$2y$10$ckalU9NSibfy8UnmTIWA9ujHQEcDNYlEtMKWf4ZHClQDxiYwc6mQi	t	2026-03-24 16:31:13.186205	2026-03-24 16:31:13.186205
10	Ebin	ebin@gmail.com	$2y$10$6NrOtq7yu9gcxayW3iIGwexoR8MVJCe6XmyHNoerwQeZQUZYIB4qS	t	2026-03-24 16:36:18.791451	2026-03-24 16:36:18.791451
\.


--
-- Data for Name: user_tasks; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.user_tasks (task_id, user_id, task_name, task_priority, task_due_date, task_created_at, task_updated_at, task_status) FROM stdin;
\.


--
-- Name: tbl_users_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_users_user_id_seq', 10, true);


--
-- Name: user_tasks_task_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.user_tasks_task_id_seq', 43, true);


--
-- Name: tbl_users tbl_users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_users
    ADD CONSTRAINT tbl_users_pkey PRIMARY KEY (user_id);


--
-- Name: tbl_users tbl_users_user_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_users
    ADD CONSTRAINT tbl_users_user_email_key UNIQUE (user_email);


--
-- Name: user_tasks user_tasks_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_tasks
    ADD CONSTRAINT user_tasks_pkey PRIMARY KEY (task_id);


--
-- Name: user_tasks fk_user; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_tasks
    ADD CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES public.tbl_users(user_id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

