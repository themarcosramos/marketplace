--
-- PostgreSQL database dump
--

-- Dumped from database version 16.0 (Ubuntu 16.0-1.pgdg22.04+1)
-- Dumped by pg_dump version 16.0 (Ubuntu 16.0-1.pgdg22.04+1)

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

--
-- Name: adminpack; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS adminpack WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION adminpack; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION adminpack IS 'administrative functions for PostgreSQL';


--
-- Name: produtos_sequence; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.produtos_sequence
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.produtos_sequence OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: produtos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.produtos (
    id integer DEFAULT nextval('public.produtos_sequence'::regclass) NOT NULL,
    tipo_id integer NOT NULL,
    nome character varying(155) NOT NULL,
    descricao text,
    ativo boolean DEFAULT true NOT NULL,
    cadastro timestamp(6) without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.produtos OWNER TO postgres;

--
-- Name: tipos_produtos_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipos_produtos_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.tipos_produtos_seq OWNER TO postgres;

--
-- Name: tipos_produtos_sequence; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipos_produtos_sequence
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.tipos_produtos_sequence OWNER TO postgres;

--
-- Name: tiposprodutos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tiposprodutos (
    id integer DEFAULT nextval('public.tipos_produtos_sequence'::regclass) NOT NULL,
    nome character varying(150) NOT NULL,
    descricao text,
    percentual_imposto numeric(10,2) NOT NULL,
    ativo boolean DEFAULT true NOT NULL,
    cadastro timestamp(6) without time zone DEFAULT now()
);


ALTER TABLE public.tiposprodutos OWNER TO postgres;

--
-- Name: vendas_sequence; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.vendas_sequence
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.vendas_sequence OWNER TO postgres;

--
-- Name: vendas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.vendas (
    id integer DEFAULT nextval('public.vendas_sequence'::regclass) NOT NULL,
    observacoes text,
    valor_total_compra numeric(10,2) NOT NULL,
    valor_total_imposto numeric(10,2) NOT NULL,
    cadastro timestamp(6) without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.vendas OWNER TO postgres;

--
-- Name: vendas_produtos_sequence; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.vendas_produtos_sequence
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.vendas_produtos_sequence OWNER TO postgres;

--
-- Name: vendasprodutos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.vendasprodutos (
    id integer DEFAULT nextval('public.vendas_produtos_sequence'::regclass) NOT NULL,
    venda_id integer NOT NULL,
    produto_id integer NOT NULL,
    quantidade integer NOT NULL,
    valor_unitario numeric(10,2) NOT NULL,
    valor_total numeric(10,2) NOT NULL,
    percentual_imposto numeric(10,2),
    valor_total_imposto numeric(10,2)
);


ALTER TABLE public.vendasprodutos OWNER TO postgres;

--
-- Data for Name: produtos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.produtos (id, tipo_id, nome, descricao, ativo, cadastro) FROM stdin;
1	10	Teclado Mecânico sem fio Logitech MX Mechanical Mini 	com teclas Retroiluminadas Tactile Quiet, Conexão USB ou Bluetooth Easy-Switch para até 3 dispositivos e Bateria Recarregável	t	2023-10-27 13:26:52
2	10	Mouse sem fio Logitech MX Master 3S	mouse sem fio MX Master 3s. O MX Master 3s oferece precisão instantânea e potencial infinito. O MX Master 3s possui a rolagem eletromagnética MagSpeed	t	2023-10-27 13:27:51
3	11	NOTEBOOK DELL XPS 13	O notebook Dell XPS 13 possui uma tela InfinityEdge com molduras de 4 mm para uma proporção tela-corpo de 80,7%, com resolução 1920 x 1200p FHD +. ele também oferece suporte a cores 100% sRGB e tem uma taxa de contraste de 1500: 1.	t	2023-10-27 13:29:11
4	11	Notebook ThinkPad E14 Ryzen 3	Segurança e estilo para o profissional moderno	t	2023-10-27 13:30:44
5	10	Modem Roteador 	Dual Band Gigabit Archer D5 Ac1200 Tp-link	t	2023-10-27 13:32:11
6	12	Smart TV LED 43"	 FULL HD TCL 43S615 - Android TV, HDMI	t	2023-10-27 13:32:55
7	11	Tablet Samsung Galaxy Tab S6 Lite	4GB, 4GB RAM, Tela Imersiva de 10.4', Câmera Traseira 8MP, Câmera frontal de 5MP, Wifi, Android 13	t	2023-10-27 13:34:24
\.


--
-- Data for Name: tiposprodutos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tiposprodutos (id, nome, descricao, percentual_imposto, ativo, cadastro) FROM stdin;
10	Periferico	dispositivos instalados junto ao computador	39.92	t	2023-10-27 12:37:11
11	laptop	É o que aqui chamamos de notebook	31.46	t	2023-10-27 13:21:49
12	Televisor	Também chamado televisão	39.80	t	2023-10-27 13:22:55
13	Tablets	dispositivo pessoal em formato de prancheta que pode ser usado para acesso à Internet e etc	48.50	t	2023-10-27 13:23:50
\.


--
-- Data for Name: vendas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.vendas (id, observacoes, valor_total_compra, valor_total_imposto, cadastro) FROM stdin;
18		1000.00	399.20	2023-10-27 13:34:29
\.


--
-- Data for Name: vendasprodutos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.vendasprodutos (id, venda_id, produto_id, quantidade, valor_unitario, valor_total, percentual_imposto, valor_total_imposto) FROM stdin;
19	18	1	1	1000.00	1000.00	39.92	399.20
\.


--
-- Name: produtos_sequence; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.produtos_sequence', 7, true);


--
-- Name: tipos_produtos_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipos_produtos_seq', 1, false);


--
-- Name: tipos_produtos_sequence; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipos_produtos_sequence', 13, true);


--
-- Name: vendas_produtos_sequence; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.vendas_produtos_sequence', 19, true);


--
-- Name: vendas_sequence; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.vendas_sequence', 18, true);


--
-- Name: vendas venda_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vendas
    ADD CONSTRAINT venda_pkey PRIMARY KEY (id);


--
-- Name: vendasprodutos vendas_produtos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vendasprodutos
    ADD CONSTRAINT vendas_produtos_pkey PRIMARY KEY (id);


--
-- Name: produtos_unique_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX produtos_unique_id ON public.produtos USING btree (id);


--
-- Name: tipos_produtos_unique_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX tipos_produtos_unique_id ON public.tiposprodutos USING btree (id);


--
-- Name: venda_id_unique; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX venda_id_unique ON public.vendas USING btree (id);


--
-- Name: vendas_produtos_id_unique; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX vendas_produtos_id_unique ON public.vendasprodutos USING btree (id);


--
-- Name: produtos produtos_tipo_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.produtos
    ADD CONSTRAINT produtos_tipo_id_foreign FOREIGN KEY (tipo_id) REFERENCES public.tiposprodutos(id);


--
-- Name: vendasprodutos vendas_produtos_produto_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vendasprodutos
    ADD CONSTRAINT vendas_produtos_produto_id_foreign FOREIGN KEY (produto_id) REFERENCES public.produtos(id);


--
-- Name: vendasprodutos vendas_produtos_venda_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vendasprodutos
    ADD CONSTRAINT vendas_produtos_venda_id_foreign FOREIGN KEY (venda_id) REFERENCES public.vendas(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

