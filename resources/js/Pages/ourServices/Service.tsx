import { PageTopSection } from "../../components";
import Layout from "../layout/Layout";
import OurServicesDetails from "../nestedPages/ourServicesDetails/OurServicesDetails";

const Service = ({ params }: { params: { serviceId: string } }) => (
    <>
        <PageTopSection title={"خدماتنا"} description={"حلول عقارية"} />
        <OurServicesDetails id={params.serviceId} />
    </>
);

Service.layout = (page: React.ReactNode) => <Layout children={page} />;

export default Service;
