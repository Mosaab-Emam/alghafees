import { PageTopSection } from "../../components";
import Layout from "../layout/Layout";
import ServicesMainContent from "./ServicesMainContent";

const OurServices = () => (
    <>
        <PageTopSection title={"خدماتنا"} description={"حلول عقارية"} />
        <ServicesMainContent />
    </>
);

OurServices.layout = (page: React.ReactNode) => <Layout children={page} />;

export default OurServices;
