#include  <opencv2/highgui/highgui.hpp>
#include  <opencv2/imgproc/imgproc.hpp>
#include  <iostream>
#include  <math.h>
#include  <ctime>
#include  <time.h>
#include  <string>
#include  <vector>

using namespace cv;
using namespace std;

#define WINDOW_NAME1 "原始图窗口"
#define WINDOW_NAME2 "拼接后的图像"

#define pi 3.1415926


int stich(string address1, string address2);


int stich(string address1, string address2)
{
	Mat src1 = cv::imread(address1);
	Mat src2 = cv::imread(address2);
	if (src1.cols == src2.cols)
	{
		Mat dst = Mat(src1.rows + src2.rows, src1.cols, src1.type(), Scalar(255, 255, 255));  //先行后列
		Mat imageROI1 = dst(Rect(0, 0, src1.cols, src1.rows));        //先列后行
		addWeighted(imageROI1, 0, src1, 1, 0., imageROI1);
		Mat imageROI2 = dst(Rect(0, src1.rows, src2.cols, src2.rows));
		addWeighted(imageROI2, 0, src2, 1, 0., imageROI2);
		src1 = dst;
		//imshow(WINDOW_NAME2, src1);
		imwrite(address1, src1);
		//cout << "src1.size:" << src1.cols << "   " << src1.rows << endl;
		return 1;
	}
	else
		return 0;
}


int main(int argc, char** argv)
{
	//Mat  src1, src2;
	string address1 = argv[1];
	string address2 = argv[2];
	//src1 = cv::imread(argv[1]);
	//src2 = cv::imread(argv[2]);
	stich(address1, address2);
	cv::waitKey(0);
	return 0;
}
