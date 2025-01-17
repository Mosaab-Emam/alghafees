import { Head } from "@inertiajs/react";

const PagesSeo = ({ title = "", description = "" }) => {
    return (
        <Head>
            <title>{title}</title>
            <meta name="description" content={description || ""} />
        </Head>
    );
};

export default PagesSeo;
