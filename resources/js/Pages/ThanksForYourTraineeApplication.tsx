import Container from "@/components/Container";
import { Link } from "@inertiajs/react";
import { Button, PageTopSection } from "../components";
import Layout from "./layout/Layout";

const ThanksForTraineeApplication = () => {
    return (
        <>
            <PageTopSection
                title={"تم استلام طلبك بنجاح"}
                description={"تم استلام طلبك بنجاح"}
            />
            <Container>
                <div className="flex flex-col items-center justify-center py-36">
                    <p className="head-line-h5 mb-8 text-center">
                        تم استلام طلبك بنجاح
                    </p>
                    <Link href="/">
                        <Button>العودة إلى الصفحة الرئيسية</Button>
                    </Link>
                </div>
            </Container>
        </>
    );
};

ThanksForTraineeApplication.layout = (page: React.ReactNode) => (
    <Layout children={page} />
);

export default ThanksForTraineeApplication;
