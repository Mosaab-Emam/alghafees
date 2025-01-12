import PageHeader from "./pageHeader/PageHeader";
import PagesSeo from "./PagesSeo";

export default function PageTopSection({ title, description }) {
    return (
        <>
            <PagesSeo title={title} description={description} />
            <PageHeader page_title={title} page_description={description} />
        </>
    );
}
