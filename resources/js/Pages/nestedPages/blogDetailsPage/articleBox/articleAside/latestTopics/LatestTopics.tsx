import { Post } from "@/types";
import LatestTopicImagBox from "./LatestTopicImagBox";

export default function LatestTopics({
    latest_posts,
}: {
    latest_posts: Array<Post>;
}) {
    return (
        <div className="flex flex-col items-start lg:gap-4 gap-8 self-stretch xl:mb-0 lg:mb-0 mb-8">
            <h3 className="head-line-h3 text-right text-Black-01">
                احدث المواضيع
            </h3>
            <LatestTopicImagBox
                latest_posts={latest_posts}
                className="md:flex flex-col md:flex-row lg:flex-col gap-4 md:gap-8 lg:gap-4 hidden"
            />
        </div>
    );
}
